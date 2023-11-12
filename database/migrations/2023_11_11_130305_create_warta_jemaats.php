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
        Schema::create('warta_jemaats', function (Blueprint $table) {
            $table->integer('id_warta')->autoIncrement();
            $table->date('tanggal_warta');
            $table->string('file_warta');
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
        Schema::dropIfExists('warta_jemaats');
    }
};
