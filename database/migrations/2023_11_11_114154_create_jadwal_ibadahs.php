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
        Schema::create('jadwal_ibadahs', function (Blueprint $table) {
            $table->integer('id_jadwal_ibadah')->autoIncrement();
            $table->string('nama_ibadah')->unique();
            $table->datetime('tanggal_waktu_pelaksanaan');
            $table->string('tempat_pelaksanaan');
            $table->string('link_streaming');
            $table->string('file_poster');
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
        Schema::dropIfExists('jadwal_ibadahs');
    }
};
