@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Data Paket Pendaftaran Membership
    </h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Tambah Data Paket
                </div>
                <form action="{{ route('owner.paketpendaftaranmembership.store') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_paket">Nama Paket</label>
                            <input type="text" name="nama_paket" id="nama_paket" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="durasi_paket">Durasi Paket (Bulan)</label>
                            <input type="number" min="1" name="durasi_paket" id="durasi_paket" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_paket">Deskripsi Paket</label>
                            <input type="text" name="deskripsi_paket" id="deskripsi_paket" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_paket">Harga Paket</label>
                            <input type="text" name="harga_paket" id="harga_paket" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Paket Pendaftaran Membership
                </div>
                <div class="card-body">
                    <table id="table" class="table table-sm table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Harga Paket</th>
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
                url: "{{ url('owner/paket-pendaftaran-membership/get-data') }}",
                method: 'GET'
            },
            columns: [
                { data: 'no', name: 'no', 'searchable': false,},
                { data: 'nama_paket' , name: 'nama_paket'},
                { data: 'harga_paket' , name: 'harga_paket'},
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
