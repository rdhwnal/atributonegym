@extends('layouts.index')

@section('content')

    <!-- heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Data Laporan
    </h1>

    <div class="row">
        <div class="col-md-12 mb-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <form class="form-inline" action="{{ url()->full() }}">
                        <input type="hidden" name="tab" value="{{ Request::get('tab') }}">
                        <div class="form-group mb-4">
                        Filter
                        </div>
                        <div class="form-group mx-sm-4 mb-4">
                        <label for="month" class="sr-only">Bulan</label>
                        <select id="month" name="month" class="form-control">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option @if(Request::get('month') == $i) selected @endif value="{{ $i }}">{{ month_indo($i) }}</option>
                                @endfor
                        </select>
                        </div>
                        <div class="form-group mx-sm-4 mb-4">
                            <label for="year" class="sr-only">Tahun</label>
                            <select id="year" name="year" class="form-control">
                                <option value="">Pilih tahun</option>
                                @for ($i = date('Y'); $i >= date('Y') - 2; $i--)
                                    <option @if(Request::get('year') == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-4">Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 mb-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    Daftar laporan
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @php
                                $month = Request::get('month');
                                $year = Request::get('year');
                                $harian = url('admin/laporan') . '?month=' . $month . '&year=' . $year . '&tab=harian';
                                $member = url('admin/laporan') . '?month=' . $month . '&year=' . $year . '&tab=member';
                            @endphp
                          <a class="nav-link @if(Request::get('tab') == 'harian') active @endif" id="nav-home-tab" data-bs-toggle="tab" href="{{ $harian }}" role="tab" aria-controls="nav-home" aria-selected="true">Kunjungan Harian</a>
                          <a class="nav-link @if(Request::get('tab') == 'member') active @endif" id="nav-profile-tab" data-bs-toggle="tab" href="{{ $member }}" role="tab" aria-controls="nav-profile" aria-selected="false">Pendaftaran Membership</a>
                        </div>
                    </nav>
                    <br>
                    @php
                        $month = Request::get('month');
                        $month = Request::get('month');
                        $harian_pdf =  url('admin/laporan/harian') . '?month=' . $month . '&year=' . $year;
                        $member_pdf =  url('admin/laporan/member') . '?month=' . $month . '&year=' . $year;
                    @endphp
                    @if (Request::get('tab') == 'harian')
                    <a href="{{ $harian_pdf }}" target="_blank" role="button" class="btn btn-md btn-success">Export PDF</a>

                        <div class="table-responsive">
                            <br>
                            <table  id="table" class="table table-sm table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Nama</th>
                                        <th>No Telepon</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @else
                    <a href="{{ $member_pdf }}" target="_blank" role="button" class="btn btn-md btn-success">Export PDF</a>

                    <div class="table-responsive">
                        <br>
                        <table  id="table2" class="table table-sm table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pendaftaran</th>
                                    <th>Kode Member</th>
                                    <th>Nama</th>
                                    <th>E-Mail</th>
                                    <th>Paket</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endif
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
                url: "{{ url('admin/laporan/get-data') }}",
                method: 'GET',
                data: function (d) {
                    d.month = $('#month option:selected').val();
                    d.year = $('#year option:selected').val();
                }
            },
            columns: [
                { data: 'no', name: 'no', 'searchable': false,},
                { data: 'invoice' , name: 'invoice'},
                { data: 'nama_pengunjung' , name: 'nama_pengunjung'},
                { data: 'no_telepon_pengunjung' , name: 'no_telepon_pengunjung'},
                { data: 'total' , name: 'total'},
                { data: 'tanggal' , name: 'tanggal', 'searchable': false, 'orderable':false },
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

            var table = $("#table2").DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: {
                url: "{{ url('admin/laporan/get-data-member') }}",
                method: 'GET',
                data: function (d) {
                    d.month = $('#month option:selected').val();
                    d.year = $('#year option:selected').val();
                }
            },
            columns: [
                { data: 'no', name: 'no', 'searchable': false,},
                { data: 'no_pendaftaran' , name: 'no_pendaftaran'},
                { data: 'members.kode_member' , name: 'members.kode_member'},
                { data: 'members.nama' , name: 'members.nama'},
                { data: 'members.email' , name: 'members.email'},
                { data: 'packages.nama_paket' , name: 'packages.nama_paket'},
                { data: 'tanggal' , name: 'tanggal', 'searchable': false, 'orderable':false },
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
