@extends('layouts.index')

@section('content')
<div class="row">

    <div class="col-xl-12 col-md-12 mb-12">
        <form class="form-inline">
            <div class="form-group mb-4">
              Filter
            </div>
            <div class="form-group mx-sm-4 mb-4">
              <label for="month" class="sr-only">Bulan</label>
              <select name="month" class="form-control">
                    <option value="">Pilih Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option @if(Request::get('month') == $i) selected @endif value="{{ $i }}">{{ month_indo($i) }}</option>
                    @endfor
              </select>
            </div>
            <div class="form-group mx-sm-4 mb-4">
                <label for="year" class="sr-only">Tahun</label>
                <select name="year" class="form-control">
                    <option value="">Pilih tahun</option>
                    @for ($i = date('Y'); $i >= date('Y') - 2; $i--)
                        <option @if(Request::get('year') == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
              </div>
            <button type="submit" class="btn btn-primary mb-4">Filter</button>
        </form>
    </div>

    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pendaftaran Membership</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_member ?: 0  }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Kunjungan Harian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_harian ?: 0  }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pendapatan Harian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pendapatan_harian ?: 0  }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <p></p>
    </div>
    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-4">Halo, {{ Auth::user()->nama }}!</h1>
            <p class="lead">Selamat datang di sistem management membership Atribut One Gym.</p>
            <hr class="my-4">
            <p>Untuk memulai bisa menggunakan tombol shortcut berikut!</p>
            <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ route('admin.kunjunganmember.index') }}" role="button">Kunjungan Member</a>
            <a class="btn btn-success btn-lg" href="{{ route('admin.kunjunganharian.index') }}" role="button">Kunjungan Harian</a>
            <a class="btn btn-warning btn-lg" href="{{ route('admin.pendaftaranmembership.index') }}" role="button">Pendaftaran Member</a>
            </p>
        </div>
    </div>
</div>

@endsection
