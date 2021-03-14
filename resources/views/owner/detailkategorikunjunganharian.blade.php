@extends('layouts.index')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">
        Detail Data Kategori Kunjungan Harian
    </h1>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Kategori Kunjungan Harian
                </div>
                <form action="{{ route('owner.kategorikunjunganharian.update', $kategoriKunjunganHarian->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $kategoriKunjunganHarian->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Nama</label>
                            <input type="number" name="harga" id="harga" class="form-control" value="{{ $kategoriKunjunganHarian->harga }}" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        <a href="{{ route('owner.kategorikunjunganharian.index') }}" class="btn btn-sm btn-warning" role="button">Batal</a>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection
