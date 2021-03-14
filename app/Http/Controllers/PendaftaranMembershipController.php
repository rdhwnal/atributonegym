<?php

namespace App\Http\Controllers;

use App\PendaftaranMembership;
use App\Member;
use App\KategoriKunjunganHarian;
use App\PaketPendaftaranMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PendaftaranMembershipController extends Controller
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
        $data = PendaftaranMembership::all();

        $no_pendaftaran = 1;
        $last_pendaftaran_id = PendaftaranMembership::orderBy('no_pendaftaran', 'desc')->limit(1)->first();
        if ($last_pendaftaran_id) {
            $no_pendaftaran = $last_pendaftaran_id->no_pendaftaran + 1;
        }

        $paket = PaketPendaftaranMembership::all();
        $kode_member = Str::random(8);

        // dd(PendaftaranMembership::with(['packages', 'admins', 'members'])->get()->toArray());
        return view('admin.pendaftaranmembership', compact('data', 'paket', 'kode_member', 'no_pendaftaran'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        DB::statement(DB::raw('set @no=0'));
        $data = PendaftaranMembership::select([
                    DB::raw('@no  := @no  + 1 AS no'),
                    'id',
                    'no_pendaftaran',
                    'id_paket',
                    'id_admin',
                    'id_member',
                ])
                ->with(['packages', 'admins', 'members']);

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
            ->orderColumn('nama', 'nama $1')
            ->addColumn('detail', function ($data) {
                    return '<a href="' . route("admin.pendaftaranmembership.show", $data->id) . '" class="btn btn-sm btn-primary" role="button">Detail</a>';
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
            'no_pendaftaran' => 'required|unique:pendaftaran_memberships,no_pendaftaran|integer',
            'kode_member' => 'required|unique:members,kode_member',
            'nama' => 'required',
            'email' => 'nullable|email|unique:members,email',
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'alamat' => 'required',
            'tanggal_mulai' => 'required|date|lte:tanggal_akhir',
            'tanggal_akhir' => 'required|date|gte:tanggal_mulai',
            'id_paket' => 'required|exists:paket_pendaftaran_memberships,id',
        ]);
        $data['id_admin'] = Auth::id();

        $member = Member::create(Arr::only($data, ['kode_member', 'nama', 'email', 'no_telepon', 'jenis_kelamin', 'alamat', 'tanggal_mulai', 'tanggal_akhir']));
        $data['id_member'] = $member->id;

        PendaftaranMembership::create(Arr::only($data, ['no_pendaftaran', 'id_paket', 'id_admin', 'id_member']));

        return redirect()
            ->route('admin.pendaftaranmembership.index')
            ->with('success', 'Data Pendaftaran Member Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PendaftaranMembership::with(['packages', 'admins', 'members'])->findOrFail($id);
        $paket = PaketPendaftaranMembership::all();

        return view('admin.detailpendaftaranmembership', compact('data', 'paket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cetak($id)
    {
        $data = PendaftaranMembership::findOrFail($id);
        $paket = PaketPendaftaranMembership::find($data->id_paket);
        $data->total = $paket->harga_paket;
        $member = Member::find($data->id_member);
        $data->nama = $member->nama;
        $data->email = $member->email;

        return view('admin.cetak-pendaftaran-member', compact('data', 'paket'));
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
            'tanggal_mulai' => 'required|date|lte:tanggal_akhir',
            'tanggal_akhir' => 'required|date|gte:tanggal_mulai',
            'id_paket' => 'required|exists:paket_pendaftaran_memberships,id',
        ]);

        $data['id_admin'] = Auth::id();
        $membership = PendaftaranMembership::findOrFail($id);
        $membership->update(Arr::only($data, ['id_paket', 'id_admin']));

        $member = Member::find($membership->id_member);
        $member->update(Arr::only($data, ['kode_member', 'nama', 'email', 'no_telepon', 'jenis_kelamin', 'alamat', 'tanggal_mulai', 'tanggal_akhir']));

        return redirect()
            ->route('admin.pendaftaranmembership.index')
            ->with('success', 'Data Pendaftaran Member Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PendaftaranMembership::find($id);

        $data->delete();

        return redirect()
            ->route('admin.pendaftaranmembership.index')
            ->with('success_delete', 'Data Kunjungan Harian Berhasil Dihapus!');
    }
}
