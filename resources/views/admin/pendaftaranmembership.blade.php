@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Pendaftaran Membership
    </h1>

    <div class="row">

        <div class="col-md-12 mb-12">
            @if($msg = Session::get('success'))
                <div class="py-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!!</strong> {{ $msg }}
                        <button class="close" type="button" data-dismiss="alert" aria-labelledby="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @elseif($msg = Session::get('success_delete'))
                <div class="py-2">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Berhasil!!</strong> {{ $msg }}
                        <button class="close" type="button" data-dismiss="alert" aria-labelledby="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-5 mb-5">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Tambah Data Membership
                </div>
                <form action="{{ route('admin.pendaftaranmembership.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_pendaftaran">No Pendaftaran</label>
                                    <input type="text" name="no_pendaftaran" id="no_pendaftaran" class="form-control" required readonly value="{{ $no_pendaftaran }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="kode_member">Kode Member</label>
                                    <input type="text" name="kode_member" id="kode_member" class="form-control" required readonly value="{{ $kode_member }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required value="{{old('nama')}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{old('email')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_telepon">No Telepon</label>
                                    <input type="number" name="no_telepon" id="no_telepon" class="form-control" required value="{{old('no_telepon')}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Berlaku Member</label>
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required value="{{old('tanggal_mulai', date('Y-m-d'))}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_akhir">Tanggal Kadaluarsa Member</label>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required value="{{old('tanggal_akhir')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_paket">Paket</label>
                                    <select name="id_paket" id="id_paket" class="form-control" required>
                                        <option value="Pria">Pilih Paket</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_paket }} | {{ $item->harga_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control" required>{{old('alamat')}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-7 mb-7">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Daftar Member
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  id="table" class="table table-sm table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pendaftaran</th>
                                    <th>Kode Member</th>
                                    <th>Nama</th>
                                    <th>Detail</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js-inline')
    <script>
    $(function() {
        var table = $("#table").DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
            url: "{{ url('admin/pendaftaran-membership/get-data') }}",
            method: 'GET'
        },
        columns: [
            { data: 'no', name: 'no', 'searchable': false,},
            { data: 'no_pendaftaran' , name: 'no_pendaftaran'},
            { data: 'members.kode_member' , name: 'members.kode_member'},
            { data: 'members.nama' , name: 'members.nama'},
            { data: 'detail', 'searchable': false, 'orderable':false },
            { data: 'action', 'searchable': false, 'orderable':false },
        ],
        scrollCollapse: true,
        columnDefs: [ {
            sortable: true
            } ,
            {
            className: "text-center", "targets": [0,3]
            },
        ],
        fixedColumns: true
        });
    });
    </script>
    @endsection

@endsection
