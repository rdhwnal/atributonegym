@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Data Member
    </h1>

    <div class="row">
        <div class="col-md-12 mb-12">
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
                                    <th>Kode Member</th>
                                    <th>Nama</th>
                                    <th>E-Mail</th>
                                    <th>Status</th>
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
                url: "{{ url('admin/member/get-data') }}",
                method: 'GET'
            },
            columns: [
                { data: 'no', name: 'no', 'searchable': false,},
                { data: 'kode_member' , name: 'kode_member'},
                { data: 'nama' , name: 'nama'},
                { data: 'email' , name: 'email'},
                { data: 'status' , name: 'status', 'searchable': false, 'orderable':false},
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
