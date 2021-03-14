@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Detail Data Kunjungan :
    </h1>

    <div class="row">
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Member & Kunjungan
                </div>
                <form >
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="invoice">Invoice</label>
                                    <input type="text" name="invoice" id="invoice" class="form-control" disabled value="{{ $data->invoice }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="kode_member">Kode Member</label>
                                    <input type="text" name="kode_member" id="kode_member" class="form-control" disabled value="{{ $data->kode_member }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                    <input type="text" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" disabled value="{{ $data->tanggal_kunjungan }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" disabled value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" name="email" id="email" class="form-control" disabled value="{{ $data->email }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_telepon">No Telepon</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" disabled value="{{ $data->no_telepon }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" disabled aria-valuenow="{{ $data->jenis_kelamin }}">
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Berlaku Member</label>
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" disabled class="form-control" value="{{ $data->tanggal_mulai }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_akhir">Tanggal Kadaluarsa Member</label>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" disabled class="form-control" value="{{ $data->tanggal_akhir }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" disabled class="form-control">{{ $data->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <a href="{{ route('admin.kunjunganmember.index') }}" role="button" class="btn btn-sm btn-warning">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
