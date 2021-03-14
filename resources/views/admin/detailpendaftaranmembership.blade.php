@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Detail Data Membership
    </h1>

    <div class="row">
        <div class="col">
            <div class="col-md-12 mb-12">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            {!! implode('', $errors->all('<li>:message</li>')) !!}
                        </ul>
                    </div>
                @endif
            </div>

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Membership
                </div>
                <form action="{{ route('admin.pendaftaranmembership.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_pendaftaran">No Pendaftaran</label>
                                    <input disabled type="text" class="form-control" required value="{{ $data->no_pendaftaran }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="kode_member">Kode Member</label>
                                    <input disabled type="text" class="form-control" required value="{{ $data->members() ? $data->members()->first()->kode_member : null }}">
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required value="{{ $data->members() ? $data->members()->first()->nama : null }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{ $data->members() ? $data->members()->first()->email : null }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_telepon">No Telepon</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" required value="{{ $data->members() ? $data->members()->first()->no_telepon : null }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    @php
                                        $gender = $data->members() ? $data->members()->first()->jenis_kelamin : null;
                                    @endphp
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option @if ($gender == "Pria") selected @endif value="Pria">Pria</option>
                                        <option @if ($gender == "Wanita") selected @endif value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Berlaku Member</label>
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" required class="form-control" value="{{ $data->members() ? $data->members()->first()->tanggal_mulai : null }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_akhir">Tanggal Kadaluarsa Member</label>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" required class="form-control" value="{{ $data->members() ? $data->members()->first()->tanggal_akhir : null }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_paket">Paket</label>
                                    @php
                                        $package = $data->packages() ? $data->packages()->first()->id : null;
                                    @endphp
                                    <select name="id_paket" id="id_paket" class="form-control" required>
                                        @foreach ($paket as $item)
                                            <option @if ($package == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama_paket }} | {{ $item->harga_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="2" required class="form-control">{{ $data->members() ? $data->members()->first()->alamat : null }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-primary">Update</button>
                            <a href="{{ route('admin.pendaftaranmembership.cetak', $data->id) }}" target="_blank" role="button" class="btn btn-sm btn-success">Cetak</a>
                            <a href="{{ route('admin.pendaftaranmembership.index') }}" role="button" class="btn btn-sm btn-warning">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
