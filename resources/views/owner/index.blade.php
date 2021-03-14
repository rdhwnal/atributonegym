@extends('layouts.index')

@section('content')

<div class="jumbotron">
    <h1 class="display-4">Halo, {{ Auth::user()->nama }}!</h1>
    <p class="lead">Selamat datang di sistem management membership Atribut One Gym.</p>
    <hr class="my-4">
    <p>Untuk memulai bisa menggunakan tombol shortcut berikut!</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="{{ route('owner.dataadmin.index') }}" role="button">Data Admin</a>
      <a class="btn btn-success btn-lg" href="{{ route('owner.kategorikunjunganharian.index') }}" role="button">Kategori Kunjungan Harian</a>
      <a class="btn btn-warning btn-lg" href="{{ route('owner.paketpendaftaranmembership.index') }}" role="button">Paket Pendaftaran Member</a>
    </p>
  </div>

@endsection
