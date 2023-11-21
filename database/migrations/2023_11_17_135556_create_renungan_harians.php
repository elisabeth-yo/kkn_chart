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
            $table->text('deskripsi');
            $table->string('gambar_bahan_bacaan');
            $table->text('sumber_referensi');
            $table->date('tanggal_dibuat');
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
