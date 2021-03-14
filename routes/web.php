<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Owner Routes Group
Route::prefix('owner')->group(function() {

    // Route auth
    Route::post('/login', 'Auth\OwnerAuthController@postLogin')->name('owner.postlogin');
    Route::post('/logout', 'Auth\OwnerAuthController@postLogout')->name('owner.postlogout');

    Route::get('/index', 'OwnerController@index')->name('owner.index');

    // Manajemen Data Admin
    Route::get('/data-admin', 'DataAdminController@index')->name('owner.dataadmin.index');
    Route::get('/data-admin/get-data', 'DataAdminController@getData')->name('owner.dataadmin.getData');
    Route::post('/data-admin', 'DataAdminController@store')->name('owner.dataadmin.store');
    Route::get('/data-admin/{id}', 'DataAdminController@show')->name('owner.dataadmin.show');
    Route::put('/data-admin/{id}/update', 'DataAdminController@update')->name('owner.dataadmin.update');
    Route::delete('/data-admin/{id}', 'DataAdminController@destroy')->name('owner.dataadmin.destroy');

    // Manajemen Data Paket Pendaftaran Membership
    Route::get('/paket-pendaftaran-membership', 'PaketPendaftaranMembershipController@index')->name('owner.paketpendaftaranmembership.index');
    Route::get('/paket-pendaftaran-membership/get-data', 'PaketPendaftaranMembershipController@getData')->name('owner.paketpendaftaranmembership.getData');
    Route::post('/paket-pendaftaran-membership', 'PaketPendaftaranMembershipController@store')->name('owner.paketpendaftaranmembership.store');
    Route::get('/paket-pendaftaran-membership/{id}', 'PaketPendaftaranMembershipController@show')->name('owner.paketpendaftaranmembership.show');
    Route::put('/paket-pendaftaran-membership/{id}/update', 'PaketPendaftaranMembershipController@update')->name('owner.paketpendaftaranmembership.update');
    Route::delete('/paket-pendaftaran-membership/{id}', 'PaketPendaftaranMembershipController@destroy')->name('owner.paketpendaftaranmembership.destroy');

    // Manajemen Data Kategori Kunjungan Harian
    Route::get('/kategori-kunjungan-harian', 'KategoriKunjunganHarianController@index')->name('owner.kategorikunjunganharian.index');
    Route::get('/kategori-kunjungan-harian/get-data', 'KategoriKunjunganHarianController@getData')->name('owner.kategorikunjunganharian.getData');
    Route::post('/kategori-kunjungan-harian', 'KategoriKunjunganHarianController@store')->name('owner.kategorikunjunganharian.store');
    Route::get('/kategori-kunjungan-harian/{id}', 'KategoriKunjunganHarianController@show')->name('owner.kategorikunjunganharian.show');
    Route::put('/kategori-kunjungan-harian/{id}/update', 'KategoriKunjunganHarianController@update')->name('owner.kategorikunjunganharian.update');
    Route::delete('/kategori-kunjungan-harian/{id}', 'KategoriKunjunganHarianController@destroy')->name('owner.kategorikunjunganharian.destroy');
});

// Admin Routes Group
Route::prefix('admin')->group(function() {

    // Route auth
    Route::post('/login', 'Auth\AdminAuthController@postLogin')->name('admin.postlogin');
    Route::post('/logout', 'Auth\AdminAuthController@postLogout')->name('admin.postlogout');

    Route::get('/index', 'AdminController@index')->name('admin.index');

    // Kunjungan Harian
    Route::get('/kunjungan-harian', 'KunjunganHarianController@index')->name('admin.kunjunganharian.index');
    Route::post('/kunjungan-harian', 'KunjunganHarianController@storeKunjunganHarian')->name('admin.kunjunganharian.storekunjunganharian');

    /**
     * Manajemen Data Member
     */
    Route::get('/member/get-data', 'DataMemberController@getData')->name('admin.datamember.getData');
    Route::get('/member', 'DataMemberController@index')->name('admin.datamember.index');
    Route::post('/member', 'DataMemberController@store')->name('admin.datamember.store');
    Route::get('/member/{id}', 'DataMemberController@show')->name('admin.datamember.show');
    Route::put('/member/{id}', 'DataMemberController@update')->name('admin.datamember.update');
    Route::delete('/member/{id}', 'DataMemberController@destroy')->name('admin.datamember.destroy');

    /**
     * Manajemen Kunjungan Member
     */
    Route::get('/kunjungan-member/get-data', 'KunjunganMemberController@getData')->name('admin.kunjunganmember.getData');
    Route::get('/kunjungan-member/get-data-nama', 'KunjunganMemberController@getDataNama')->name('admin.kunjunganmember.getDataNama');
    Route::get('/kunjungan-member', 'KunjunganMemberController@index')->name('admin.kunjunganmember.index');
    Route::post('/kunjungan-member', 'KunjunganMemberController@store')->name('admin.kunjunganmember.store');
    Route::get('/kunjungan-member/{id}', 'KunjunganMemberController@show')->name('admin.kunjunganmember.show');
    Route::delete('/kunjungan-member/{id}', 'KunjunganMemberController@destroy')->name('admin.kunjunganmember.destroy');

    /**
     * Manajemen Kunjungan Harian
     */
    Route::get('/kunjungan-harian/get-data', 'KunjunganHarianController@getData')->name('admin.kunjunganharian.getData');
    Route::get('/kunjungan-harian/get-data-nama', 'KunjunganHarianController@getDataNama')->name('admin.kunjunganharian.getDataNama');
    Route::get('/kunjungan-harian', 'KunjunganHarianController@index')->name('admin.kunjunganharian.index');
    Route::post('/kunjungan-harian', 'KunjunganHarianController@store')->name('admin.kunjunganharian.store');
    Route::get('/kunjungan-harian/{id}', 'KunjunganHarianController@show')->name('admin.kunjunganharian.show');
    Route::get('/kunjungan-harian/{id}/cetak', 'KunjunganHarianController@cetak')->name('admin.kunjunganharian.cetak');
    Route::put('/kunjungan-harian/{id}', 'KunjunganHarianController@update')->name('admin.kunjunganharian.update');
    Route::delete('/kunjungan-harian/{id}', 'KunjunganHarianController@destroy')->name('admin.kunjunganharian.destroy');

    /**
     * Manajemen Pendaftaran Membership
     */
    Route::get('/pendaftaran-membership/get-data', 'PendaftaranMembershipController@getData')->name('admin.pendaftaranmembership.getData');
    Route::get('/pendaftaran-membership/get-data-nama', 'PendaftaranMembershipController@getDataNama')->name('admin.pendaftaranmembership.getDataNama');
    Route::get('/pendaftaran-membership', 'PendaftaranMembershipController@index')->name('admin.pendaftaranmembership.index');
    Route::post('/pendaftaran-membership', 'PendaftaranMembershipController@store')->name('admin.pendaftaranmembership.store');
    Route::get('/pendaftaran-membership/{id}', 'PendaftaranMembershipController@show')->name('admin.pendaftaranmembership.show');
    Route::get('/pendaftaran-membership/{id}/cetak', 'PendaftaranMembershipController@cetak')->name('admin.pendaftaranmembership.cetak');
    Route::put('/pendaftaran-membership/{id}', 'PendaftaranMembershipController@update')->name('admin.pendaftaranmembership.update');
    Route::delete('/pendaftaran-membership/{id}', 'PendaftaranMembershipController@destroy')->name('admin.pendaftaranmembership.destroy');

    /**
     * Laporan Transaksi
     */
    Route::get('/laporan', 'LaporanController@index')->name('admin.laporan.index');
    Route::get('/laporan/get-data', 'LaporanController@getData')->name('admin.laporan.getData');
    Route::get('/laporan/get-data-member', 'LaporanController@getDataMember')->name('admin.laporan.getDataMember');
    Route::get('/laporan/harian', 'LaporanController@cetakHarian')->name('admin.laporan.cetakHarian');
    Route::get('/laporan/member', 'LaporanController@cetakMember')->name('admin.laporan.cetakMember');

});
