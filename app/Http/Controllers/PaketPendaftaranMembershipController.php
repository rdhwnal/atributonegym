<?php

namespace App\Http\Controllers;

use App\PaketPendaftaranMembership;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PaketPendaftaranMembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPaketPendaftaranMembership = PaketPendaftaranMembership::all();

        return view('owner.paketpendaftaranmembership', compact('dataPaketPendaftaranMembership'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = PaketPendaftaranMembership::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'nama_paket',
                    'harga_paket',
                    'id',
                ]);

        if ($keyword = $request->get('search')['value']) {
            $data->search($keyword);
        }

        return  Datatables::of($data)
            ->orderColumn('nama_paket', 'nama_paket $1')
            ->addColumn('detail', function ($data) {
                return '<a href="' . route("owner.paketpendaftaranmembership.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
            })
            ->addColumn('action', function ($data) {
                    return '<a  id="hapus" data-target="#modal-hapus" data-toggle="modal" data-id="'.$data->id.'" data-nama="'.$data->nama.'"  class="btn btn-sm btn-danger waves-effect waves-light">Hapus</a>';
            })
            ->rawColumns(['detail', 'action', 'status'])
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
        $this->validate($request, [
            'nama_paket' => 'required',
            'durasi_paket' => 'required|integer',
            'deskripsi_paket' => 'required',
            'harga_paket' => 'required|integer',
        ]);

        PaketPendaftaranMembership::create([
            'nama_paket' => $request->nama_paket,
            'durasi_paket' => $request->durasi_paket,
            'deskripsi_paket' => $request->deskripsi_paket,
            'harga_paket' => (int)$request->harga_paket,
        ]);

        return redirect()
            ->route('owner.paketpendaftaranmembership.index')
            ->with('success', 'Data Paket Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataPaketPendaftaranMembership = PaketPendaftaranMembership::find($id);

        return view('owner.detailpaketpendaftaranmembership', compact('dataPaketPendaftaranMembership'));
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
        $dataPaketPendaftaranMembership = PaketPendaftaranMembership::whereId($id)->update([
            'nama_paket' => $request->input('nama_paket'),
            'durasi_paket' => $request->input('durasi_paket'),
            'deskripsi_paket' => $request->input('deskripsi_paket'),
            'harga_paket' => $request->input('harga_paket'),
        ]);

        return redirect()
            ->route('owner.paketpendaftaranmembership.index')
            ->with('success', 'Data Paket Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataPaketPendaftaranMembership = PaketPendaftaranMembership::find($id);

        $dataPaketPendaftaranMembership->delete();

        return redirect()
            ->route('owner.paketpendaftaranmembership.index')
            ->with('success_delete', 'Data Paket Berhasil Dihapus!');
    }
}
