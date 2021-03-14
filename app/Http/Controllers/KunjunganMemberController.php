<?php

namespace App\Http\Controllers;

use App\KunjunganMember;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class KunjunganMemberController extends Controller
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
        $data = KunjunganMember::all();
        $invoice = 'member-' . date('Ymdhis');

        return view('admin.kunjunganmember', compact('data', 'invoice'));
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
        $data = KunjunganMember::LeftJoin('members', function($join){
                        $join->on('members.id','=','kunjungan_members.member_id');
                    })
                    ->select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'kunjungan_members.invoice',
                    'kunjungan_members.kode_member',
                    'members.nama as nama',
                    'kunjungan_members.id',
                    'kunjungan_members.created_at',
                ]);

        if ($keyword = $request->get('search')['value']) {
            $data = $data->where(function ($query) use($keyword) {
                $query->where('kunjungan_members.invoice', 'like', '%' . $keyword . '%')
                      ->orWhere('kunjungan_members.kode_member', 'like', '%' . $keyword . '%')
                      ->orWhere('members.nama', 'like', '%' . $keyword . '%');
            });
        }

        return  Datatables::of($data)
            ->addColumn('detail', function ($data) {
                    return '<a href="' . route("admin.kunjunganmember.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
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
            'kode_member' => 'required|exists:members,kode_member',
            'invoice' => 'required|unique:kunjungan_members,invoice',
        ]);

        $member = Member::where('kode_member', $data['kode_member'])->first();
        $data['member_id'] = $member->id;

        KunjunganMember::create($data);

        return redirect()
            ->route('admin.kunjunganmember.index')
            ->with('success', 'Data Kunjungan Member Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kunjungan = KunjunganMember::findOrFail($id);
        $data = Member::find($kunjungan->member_id);
        $data->tanggal_kunjungan = tanggal_indo($kunjungan->created_at);
        $data->invoice = $kunjungan->invoice;

        return view('admin.detailkunjunganmember', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KunjunganMember::find($id);

        $data->delete();

        return redirect()
            ->route('admin.kunjunganmember.index')
            ->with('success_delete', 'Data Kunjungan Member Berhasil Dihapus!');
    }
}
