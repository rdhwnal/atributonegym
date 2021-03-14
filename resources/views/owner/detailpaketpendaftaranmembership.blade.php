@extends('layouts.index')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">
        Detail Data Paket Pendaftaran Membership
    </h1>

    <div class="row">
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Paket Pendaftaran Membership
                </div>
                <form action="{{ route('owner.paketpendaftaranmembership.update', $dataPaketPendaftaranMembership->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama_paket">Nama Paket</label>
                                    <input type="text" name="nama_paket" id="nama_paket" class="form-control" required value="{{ $dataPaketPendaftaranMembership->nama_paket }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="durasi_paket">Durasi Paket (Bulan)</label>
                                    <input type="number" min="1" name="durasi_paket" id="durasi_paket" class="form-control" required value="{{ $dataPaketPendaftaranMembership->durasi_paket }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="deskripsi_paket">Deskripsi Paket</label>
                                    <input type="text" name="deskripsi_paket" id="deskripsi_paket" class="form-control" required value="{{ $dataPaketPendaftaranMembership->deskripsi_paket }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="harga_paket">Harga Paket</label>
                                    <input type="text" name="harga_paket" id="harga_paket" class="form-control" required value="{{ $dataPaketPendaftaranMembership->harga_paket }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-primary">Update</button>
                            <a href="{{ route('owner.paketpendaftaranmembership.index') }}" role="button" class="btn btn-sm btn-warning">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
