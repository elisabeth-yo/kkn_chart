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
        Schema::create('data_jemaats', function (Blueprint $table) {
            $table->integer('id_data_jemaat')->autoIncrement();
            $table->string('kode_dokumen');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('golongan_darah');
            $table->string('alamat_domisili');
            $table->string('rt');
            $table->string('rw');
            $table->string('kode_pos');
            $table->string('nomor_telepon_rumah');
            $table->string('nomor_telepon_seluler');
            $table->string('status_perkawinan');
            $table->string('status_hubungan_dalam_keluarga');
            $table->string('pendidikan_terakhir');
            $table->string('bidang_ilmu');
            $table->string('aktivitas_keseharian');
            $table->string('pekerjaan_terakhir');
            $table->string('nama_instansi_tempat_bekerja');
            $table->string('status_hubungan_kerja');
            $table->string('gereja_tempat_baptis');
            $table->date('tanggal_baptis');
            $table->string('gereja_tempat_sidi');
            $table->date('tanggal_sidi');
            $table->float('rata_rata_pengeluaran');
            $table->float('rata_rata_penghasilan');
            $table->string('status_rumah_tinggal');
            $table->string('transportasi_utama');
            $table->string('foto');
            $table->string('id_wilayah');
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
        Schema::dropIfExists('data_jemaats');
    }
};
