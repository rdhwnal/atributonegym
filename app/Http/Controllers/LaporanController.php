<?php

namespace App\Http\Controllers;

use App\Admin;
use App\KunjunganHarian;
use App\PendaftaranMembership;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::all();

        return view('admin.laporan', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = KunjunganHarian::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'invoice',
                    'nama_pengunjung',
                    'no_telepon_pengunjung',
                    'total',
                    'id',
                    'created_at',
                ]);

        if ($month = $request->month) {
            $data = $data->whereMonth('created_at', $month);
        }

        if ($year = $request->year) {
            $data = $data->whereYear('created_at', $year);
        }

        if ($keyword = $request->get('search')['value']) {
            $data = $data->where(function ($query) use($keyword) {
                $query->where('invoice', 'like', '%' . $keyword . '%')
                      ->orWhere('nama_pengunjung', 'like', '%' . $keyword . '%')
                      ->orWhere('no_telepon_pengunjung', 'like', '%' . $keyword . '%');
            });
        }

        return  Datatables::of($data)
            ->orderColumn('nama_pengunjung', 'nama_pengunjung $1')
            ->editColumn('tanggal', function ($data) {
                if (!is_null($data->created_at)) {
                    $tanggal = tanggal_indo($data->created_at, true);
                    return $tanggal;
                } else {
                    return $data->created_at;
                }
            })
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataMember(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = PendaftaranMembership::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'id',
                    'no_pendaftaran',
                    'id_paket',
                    'id_admin',
                    'id_member',
                    'created_at',
                ])
                ->with(['packages', 'admins', 'members']);

        if ($month = $request->month) {
            $data = $data->whereMonth('created_at', $month);
        }

        if ($year = $request->year) {
            $data = $data->whereYear('created_at', $year);
        }

        if ($keyword = $request->get('search')['value']) {
            $data = $data->where(function ($query) use($keyword) {
                $query->where('no_pendaftaran', 'like', '%' . $keyword . '%')
                        ->orWhereHas('members', function($q) use($keyword) {
                            $q->where('kode_member', 'like', '%' . $keyword . '%');
                        })
                        ->orWhereHas('members', function($q) use($keyword) {
                            $q->where('nama', 'like', '%' . $keyword . '%');
                        });
            });
        }

        return  Datatables::of($data)
                ->editColumn('tanggal', function ($data) {
                    if (!is_null($data->created_at)) {
                        $tanggal = tanggal_indo($data->created_at, true);
                        return $tanggal;
                    } else {
                        return $data->created_at;
                    }
                })
                ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cetakHarian(Request $request)
    {
        $data = KunjunganHarian::select([
            DB::raw('@no  := @no  + 1 AS no'),
            'invoice',
            'nama_pengunjung',
            'no_telepon_pengunjung',
            'total',
            'id',
            'created_at',
        ]);

        if ($month = $request->month) {
            $data = $data->whereMonth('created_at', $month);
            $month = month_indo($month);
        }

        if ($year = $request->year) {
            $data = $data->whereYear('created_at', $year);
        }

        $data = $data->get();
        foreach ($data as $key => $value) {
            $value->tanggal = tanggal_indo($value->created_at, true);
        }

        $pdf = PDF::loadView('admin.harian-pdf', ['data' => $data, 'month' => $month, 'year' => $year]);

        $fileName = 'laporan-kunjungan-harian-' . date('Y-m-d') . '.pdf';
        return $pdf->download($fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cetakMember(Request $request)
    {
        $data = PendaftaranMembership::select([
            DB::raw('@no  := @no  + 1 AS no'),
            'id',
            'no_pendaftaran',
            'id_paket',
            'id_admin',
            'id_member',
            'created_at',
        ])
        ->with(['packages', 'admins', 'members']);

        if ($month = $request->month) {
            $data = $data->whereMonth('created_at', $month);
            $month = month_indo($month);
        }

        if ($year = $request->year) {
            $data = $data->whereYear('created_at', $year);
        }

        $data = $data->get();
        foreach ($data as $key => $value) {
            $value->tanggal = tanggal_indo($value->created_at, true);
        }

        $pdf = PDF::loadView('admin.member-pdf', ['data' => $data, 'month' => $month, 'year' => $year]);

        $fileName = 'laporan-pendaftaran-member-' . date('Y-m-d') . '.pdf';
        return $pdf->download($fileName);
    }
}
