<?php

namespace App\Http\Controllers;

use App\KategoriKunjunganHarian;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class KategoriKunjunganHarianController extends Controller
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
        $kategoriKunjunganHarian = KategoriKunjunganHarian::all();

        return view('owner.kategorikunjunganharian', compact('kategoriKunjunganHarian'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = KategoriKunjunganHarian::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'nama',
                    'harga',
                    'id',
                ]);

        if ($keyword = $request->get('search')['value']) {
            $data->search($keyword);
        }

        return  Datatables::of($data)
            ->orderColumn('nama', 'nama $1')
            ->addColumn('detail', function ($data) {
                return '<a href="' . route("owner.kategorikunjunganharian.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
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
            'nama' => 'required',
            'harga' => 'required',
        ]);

        KategoriKunjunganHarian::create([
            'nama' => $request->nama,
            'harga' => (int)$request->harga
        ]);

        return redirect()
            ->route('owner.kategorikunjunganharian.index')
            ->with('success', 'Data Kategori Kunjungan Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategoriKunjunganHarian = KategoriKunjunganHarian::find($id);

        return view('owner.detailkategorikunjunganharian', compact('kategoriKunjunganHarian'));
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
        $kategoriKunjunganHarian = KategoriKunjunganHarian::whereId($id)->update([
            'nama' => $request->input('nama'),
            'harga' => (int)$request->input('harga'),
        ]);

        return redirect()
            ->route('owner.kategorikunjunganharian.index')
            ->with('success', 'Data Kategori Kunjungan Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriKunjunganHarian = KategoriKunjunganHarian::find($id);

        $kategoriKunjunganHarian->delete();

        return redirect()
            ->route('owner.kategorikunjunganharian.index')
            ->with('success_delete', 'Data Kategori Kunjungan Harian Berhasil Dihapus!');
    }
}
