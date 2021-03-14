<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class DataAdminController extends Controller
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
        $dataAdmin = Admin::all();

        return view('owner.dataadmin', compact('dataAdmin'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = Admin::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'nama',
                    'email',
                    'id',
                ]);

        if ($keyword = $request->get('search')['value']) {
            $data->search($keyword);
        }

        return  Datatables::of($data)
            ->orderColumn('nama', 'nama $1')
            ->addColumn('detail', function ($data) {
                return '<a href="' . route("owner.dataadmin.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
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
            'nama' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'password' => 'required|min:8',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);
        $data['password'] = Hash::make($request->password);

        Admin::create($data);

        return redirect()
            ->route('owner.dataadmin.index')
            ->with('success', 'Data Admin Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataAdmin = Admin::find($id);

        return view('owner.detaildataadmin', compact('dataAdmin'));
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
            'email' => 'required|email|unique:admins,email,' . $id,
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        if ($request->password) {
            $data['password'] =  Hash::make($request->password);
        }

        Admin::whereId($id)->update($data);

        return redirect()
                ->route('owner.dataadmin.index')
                ->with('success', 'Data Admin Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataAdmin = Admin::find($id);

        $dataAdmin->delete();

        return redirect()
            ->route('owner.dataadmin.index')
            ->with('success_delete', 'Data Admin Berhasil Dihapus!');
    }
}
