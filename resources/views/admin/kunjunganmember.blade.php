@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Kunjungan Member
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
                    Tambah Kunjungan Member
                </div>
                <form action="{{ route('admin.kunjunganmember.store') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="kode_member">Kode Member</label>
                                    <input type="text" name="kode_member" id="kode_member" class="form-control" required value="{{old('kode_member')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama">Nama Member</label>
                                    <input type="text" name="nama" id="nama" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="invoice">Invoice</label>
                                    <input type="text" name="invoice" id="invoice" class="form-control" readonly value="{{ $invoice }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <div class="ml-auto">
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 mb-8">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Kunjungan Member
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  id="table" class="table table-sm table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Kode Member</th>
                                    <th>Nama</th>
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
        url: "{{ url('admin/kunjungan-member/get-data') }}",
        method: 'GET'
      },
      columns: [
        { data: 'no', name: 'no', 'searchable': false,},
        { data: 'invoice' , name: 'invoice'},
        { data: 'kode_member' , name: 'kode_member'},
        { data: 'nama' , name: 'members.nama'},
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

$(document).ready(function(){
    $("#kode_member").keyup(function(){
        $.ajax({
        type: "GET",
        url: "{{ url('admin/kunjungan-member/get-data-nama') }}",
        data: $('#kode_member').serialize(),
        }).done(function(data){
            $('#nama').val(data);
        });
    });
});
</script>
@endsection

@endsection
