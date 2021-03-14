<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_pendaftaran');

            $table->biginteger('id_paket')->nullable()->index()->unsigned();
            $table->biginteger('id_admin')->nullable()->index()->unsigned();
            $table->biginteger('id_member')->nullable()->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('pendaftaran_memberships', function (Blueprint $table) {
            $table->foreign('id_paket')
                  ->references('id')->on('paket_pendaftaran_memberships')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('id_admin')
                  ->references('id')->on('admins')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('id_member')
                  ->references('id')->on('members')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_memberships');
    }
}
