<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungan_harians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice');
            $table->string('nama_pengunjung');
            $table->string('no_telepon_pengunjung');
            $table->integer('total');

            $table->biginteger('kategorikunjunganharian_id')->nullable()->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('kunjungan_harians', function (Blueprint $table) {
            $table->foreign('kategorikunjunganharian_id')
                  ->references('id')->on('kategori_kunjungan_harians')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungan_harians');
    }
}
