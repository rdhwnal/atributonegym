<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketPendaftaranMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_pendaftaran_memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_paket', '50');
            $table->integer('durasi_paket');
            $table->string('deskripsi_paket', '100');
            $table->integer('harga_paket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_pendaftaran_memberships');
    }
}
