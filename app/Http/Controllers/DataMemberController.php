<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataMemberController extends Controller
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
        $data = Member::all();
        $kode_member = Str::random(8);

        return view('admin.datamember', compact('data', 'kode_member'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = Member::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'nama',
                    'email',
                    'kode_member',
                    'id',
                    'id',
                ]);

        if ($keyword = $request->get('search')['value']) {
            $data->search($keyword);
        }

        return  Datatables::of($data)
            ->orderColumn('nama', 'nama $1')
            ->addColumn('status', function ($data) {
                if ($data->status == "Aktif") {
                    return '<span class="badge badge-success">' . $data->status . '</span>';
                } else {
                    return '<span class="badge badge-danger">' . $data->status . '</span>';
                }
            })
            ->addColumn('detail', function ($data) {
                return '<a href="' . route("admin.datamember.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
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
        $data = $this->validate($request, [
            'kode_member' => 'required|unique:members,kode_member',
            'nama' => 'required',
            'email' => 'nullable|email|unique:members,email',
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'alamat' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        Member::create($data);

        return redirect()
            ->route('admin.datamember.index')
            ->with('success', 'Data Member Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Member::find($id);

        return view('admin.detaildatamember', compact('data'));
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
            'nama' => 'required',
            'email' => 'nullable|email|unique:members,email,' . $id,
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'alamat' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        $data = Member::whereId($id)->update($data);

        return redirect()
                ->route('admin.datamember.index')
                ->with('success', 'Data Member Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Member::find($id);

        $data->delete();

        return redirect()
            ->route('admin.datamember.index')
            ->with('success_delete', 'Data Member Berhasil Dihapus!');
    }
}
