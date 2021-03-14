<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungan_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice');
            $table->string('kode_member');
            $table->biginteger('member_id')->nullable()->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('kunjungan_members', function (Blueprint $table) {
            $table->foreign('member_id')
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
        Schema::dropIfExists('kunjungan_members');
    }
}
