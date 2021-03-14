@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Kategori Kunjungan Harian
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
                    Tambah Kategori
                </div>
                <form action="{{ route('owner.kategorikunjunganharian.store') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Data Kategori
                </div>
                <div class="card-body">
                    <table id="table" class="table table-sm table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Harga Kategori</th>
                                <th>Detail</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                    </table>
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
                url: "{{ url('owner/kategori-kunjungan-harian/get-data') }}",
                method: 'GET'
            },
            columns: [
                { data: 'no', name: 'no', 'searchable': false,},
                { data: 'nama' , name: 'nama'},
                { data: 'harga' , name: 'harga'},
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
