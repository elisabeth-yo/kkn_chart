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
        Schema::create('persembahans', function (Blueprint $table) {
            $table->integer('id_persembahan')->autoIncrement();
            $table->integer('perolehan_persembahan');
            $table->string('keterangan');
            $table->string('id_jadwal_ibadah');
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
        Schema::dropIfExists('persembahans');
    }
};
