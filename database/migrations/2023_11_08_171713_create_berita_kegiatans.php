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
        Schema::create('berita_kegiatans', function (Blueprint $table) {
            $table->integer('id_berita')->autoIncrement();
            $table->string('nama_kegiatan')->unique();
            $table->text('deskripsi_kegiatan');
            $table->date('tanggal_pelaksanaan');
            $table->string('poster_kegiatan');
            $table->string('foto_kegiatan');
            $table->string('id_pengguna');
            
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
        Schema::dropIfExists('berita_kegiatans');
    }
};
