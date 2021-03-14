@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Detail Data Kunjungan Harian :
    </h1>

    <div class="row">
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Kunjungan Harian
                </div>
                <div class="col-md-12 mb-12">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                {!! implode('', $errors->all('<li>:message</li>')) !!}
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{ route('admin.kunjunganharian.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="invoice">Inovice</label>
                                    <input disabled type="text" class="form-control" required value="{{ $data->invoice }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                    <input disabled type="text" class="form-control" required value="{{ $data->tanggal_kunjungan }}">
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama_pengunjung">Nama Pengunjung</label>
                                    <input type="text" name="nama_pengunjung" id="nama_pengunjung" class="form-control" required value="{{ $data->nama_pengunjung }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_telepon_pengunjung">No Telepon</label>
                                    <input type="text" name="no_telepon_pengunjung" id="no_telepon_pengunjung" class="form-control" required value="{{ $data->no_telepon_pengunjung }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="kategorikunjunganharian_id">Kategori Pengunjung</label>
                                    <select name="kategorikunjunganharian_id" id="kategori_id" class="form-control" required>
                                        @foreach($kategori as $value)
                                        <option @if($data->kategorikunjunganharian_id == $value->id) selected @endif value="{{ $value->id }}" harga="{{$value->harga}}">{{ $value->nama . ' - ' . $value->harga }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="text" name="total" id="total" class="form-control" readonly required value="{{ $data->total }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-primary">Update</button>
                            <a href="{{ route('admin.kunjunganharian.cetak', $data->id) }}" target="_blank" role="button" class="btn btn-sm btn-success">Cetak</a>
                            <a href="{{ route('admin.kunjunganharian.index') }}" role="button" class="btn btn-sm btn-warning">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js-inline')
        <script>
        $("#kategori_id").change(function(){
            var harga = $('option:selected', this).attr("harga");
            $("#total").val(harga);
        });
        </script>
    @endsection
@endsection
