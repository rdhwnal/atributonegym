<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('nama', '50');
        //     $table->string('email', '50')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('no_telepon', '13');
        //     $table->string('password');
        //     $table->string('jenis_kelamin', '6');
        //     $table->date('tanggal_lahir');
        //     $table->string('alamat');
        //     $table->boolean('membership')->default(1);
        //     $table->date('start_date');
        //     $table->date('end_date');

        //     $table->rememberToken();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
    }
}
