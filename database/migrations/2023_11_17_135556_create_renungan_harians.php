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
        Schema::create('renungan_harians', function (Blueprint $table) {
            $table->integer('id_renungan')->autoIncrement();
            $table->string('judul')->unique();
            $table->string('deskripsi');
            $table->string('gambar_bahan_bacaan');
            $table->string('sumber_referensi');
            $table->date('tanggal_dibuat');
            $table->string('id_kategori_bacaan');
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
        Schema::dropIfExists('renungan_harians');
    }
};
