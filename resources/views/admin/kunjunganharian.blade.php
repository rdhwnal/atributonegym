@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Kunjungan Harian
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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
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

        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Tambahn Kunjungan Harian
                </div>

                <form action="{{ route('admin.kunjunganharian.store') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategorikunjunganharian_id">Kategori Kunjungan Harian</label>
                            <select name="kategorikunjunganharian_id" id="kategori_id" class="form-control">
                                <option>Pilih Kategori</option>
                                @foreach($kategori as $data)
                                    <option @if(old('kategorikunjunganharian_id') == $data->id) selected @endif value="{{ $data->id }}" harga="{{$data->harga}}">{{ $data->nama . ' - ' . $data->harga }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="invoice">Invoice</label>
                            <input type="text" name="invoice" id="invoice" class="form-control" required readonly value="{{ $invoice }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_pengunjung">Nama Pengunjung</label>
                            <input type="text" name="nama_pengunjung" id="nama_pengunjung" class="form-control" required value="{{ old('nama_pengunjung') }}">
                        </div>
                        <div class="form-group">
                            <label for="no_telepon_pengunjung">No. Telepon</label>
                            <input type="text" name="no_telepon_pengunjung" id="no_telepon_pengunjung" class="form-control" required value="{{ old('no_telepon_pengunjung') }}">
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" name="total" id="total" readonly class="form-control" required value="{{ old('total') }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 mb-8">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Daftar Kunjungan harian
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  id="table" class="table table-sm table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama</th>
                                    <th>No Telepon</th>
                                    <th>Total</th>
                                    <th>Tanggal Kunjungan</th>
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
                url: "{{ url('admin/kunjungan-harian/get-data') }}",
                method: 'GET'
            },
            columns: [
                { data: 'no', name: 'no', 'searchable': false,},
                { data: 'invoice' , name: 'invoice'},
                { data: 'nama_pengunjung' , name: 'nama_pengunjung'},
                { data: 'no_telepon_pengunjung' , name: 'no_telepon_pengunjung'},
                { data: 'total' , name: 'total'},
                { data: 'created_at' , name: 'created_at'},
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

        $("#kategori_id").change(function(){
            var harga = $('option:selected', this).attr("harga");
            $("#total").val(harga);
        });
        </script>
    @endsection

@endsection
