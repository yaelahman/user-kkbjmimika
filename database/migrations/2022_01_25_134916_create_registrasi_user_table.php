<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasiUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_user', function (Blueprint $table) {
            $table->id();
            $table->string('no_user')->nullable();
            $table->string('nama');
            $table->string('no_hp')->unique();
            $table->string('jenis_pekerjaan');
            $table->string('alamat');
            $table->string('foto');
            $table->string('verifikasi_kode');
            $table->integer('is_active');
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
        Schema::dropIfExists('registrasi_user');
    }
}
