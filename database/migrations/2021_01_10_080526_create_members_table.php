<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_member', '8');
            $table->string('nama', '50');
            $table->string('email', '50');
            $table->string('no_telepon', '13');
            $table->string('jenis_kelamin', '6');
            $table->string('alamat', '50');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');

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
        Schema::dropIfExists('members');
    }
}
