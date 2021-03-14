<?php

namespace App\Http\Controllers;

use App\KunjunganHarian;
use App\Member;
use App\KategoriKunjunganHarian;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class KunjunganHarianController extends Controller
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
        $data = KunjunganHarian::all();
        $kategori = KategoriKunjunganHarian::all();
        $invoice = 'daily-' . date('Ymdhis');

        return view('admin.kunjunganharian', compact('data', 'kategori', 'invoice'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $kode
     * @return \Illuminate\Http\Response
     */
    public function getDataNama(Request $request)
    {
        $kode = $request->kode_member;
        $kunjungan = Member::where('kode_member', $kode)->first();
        if ($kunjungan) {
            return $kunjungan->nama;
        }

        return '';
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
                    'id',
                    'total',
                    'kategorikunjunganharian_id',
                    'created_at',
                ]);

        if ($keyword = $request->get('search')['value']) {
            $data = $data->where(function ($query) use($keyword) {
                $query->where('invoice', 'like', '%' . $keyword . '%')
                      ->orWhere('nama_pengunjung', 'like', '%' . $keyword . '%')
                      ->orWhere('no_telepon_pengunjung', 'like', '%' . $keyword . '%');
            });
        }

        return  Datatables::of($data)
            ->orderColumn('nama_pengunjung', 'nama_pengunjung $1')
            ->addColumn('detail', function ($data) {
                    return '<a href="' . route("admin.kunjunganharian.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
            })
            ->addColumn('action', function ($data) {
                    return '<a  id="hapus" data-target="#modal-hapus" data-toggle="modal" data-id="'.$data->id.'" data-nama="'.$data->invoice.'"  class="btn btn-sm btn-danger waves-effect waves-light">Hapus</a>';
            })
            ->editColumn('created_at', function ($data) {
                if (!is_null($data->created_at)) {
                    $tanggal = tanggal_indo($data->created_at, true);
                    return $tanggal;
                } else {
                    return $data->tanggal;
                }
            })
            ->editColumn('total', function ($data) {
                return "Rp. " . number_format($data->total);
            })
            ->rawColumns(['detail', 'action', 'created_at'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'invoice' => 'required|unique:kunjungan_harians,invoice',
            'nama_pengunjung' => 'required',
            'no_telepon_pengunjung' => 'required',
            'total' => 'required|numeric',
            'kategorikunjunganharian_id' => 'required|exists:kategori_kunjungan_harians,id',
        ]);

        KunjunganHarian::create($data);

        return redirect()
            ->route('admin.kunjunganharian.index')
            ->with('success', 'Data Kunjungan Harian Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = KunjunganHarian::findOrFail($id);
        $kategori = KategoriKunjunganHarian::all();
        $data->tanggal_kunjungan = tanggal_indo($data->created_at);

        return view('admin.detailkunjunganharian', compact('data', 'kategori'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cetak($id)
    {
        $data = KunjunganHarian::findOrFail($id);
        $kategori = KategoriKunjunganHarian::all();
        $data->tanggal_kunjungan = tanggal_indo($data->created_at);

        return view('admin.cetak-kunjungan-harian', compact('data', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'nama_pengunjung' => 'required',
            'no_telepon_pengunjung' => 'required',
            'total' => 'required|numeric',
            'kategorikunjunganharian_id' => 'required|exists:kategori_kunjungan_harians,id',
        ]);

        $model = KunjunganHarian::findOrFail($id);
        $model->update($data);

        return redirect()
            ->route('admin.kunjunganharian.index')
            ->with('success', 'Data Kunjungan Harian Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KunjunganHarian::find($id);

        $data->delete();

        return redirect()
            ->route('admin.kunjunganharian.index')
            ->with('success_delete', 'Data Kunjungan Harian Berhasil Dihapus!');
    }
}
