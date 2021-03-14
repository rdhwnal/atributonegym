@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Detail Data Admin :
    </h1>

    <div class="row">
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Admin
                </div>
                <form action="{{ route('owner.dataadmin.update', $dataAdmin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required value="{{ $dataAdmin->nama }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{ $dataAdmin->email }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_telepon">No Telepon</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" required value="{{ $dataAdmin->no_telepon }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option @if($dataAdmin->jenis_kelamin == "Pria") selected @endif value="Pria">Pria</option>
                                        <option @if($dataAdmin->jenis_kelamin == "Wanita") selected @endif value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="form-control" value="{{ $dataAdmin->tanggal_lahir }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" required class="form-control">{{ $dataAdmin->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-primary">Update</button>
                            <a href="{{ route('owner.dataadmin.index') }}" role="button" class="btn btn-sm btn-warning">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
