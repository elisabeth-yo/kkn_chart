<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_jemaats', function (Blueprint $table) {
            $table->integer('id_presensi_jemaat')->autoIncrement();
            $table->date('tanggal_waktu_presensi');
            $table->integer('id_jadwal_ibadah');
            $table->integer('id_pengguna');
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
        Schema::dropIfExists('presensi_jemaats');
    }
};
