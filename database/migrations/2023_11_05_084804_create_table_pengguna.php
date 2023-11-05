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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->integer('id_pengguna')->autoIncrement();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profil_pengguna');
            $table->integer('id_kategori_pengguna');
            $table->integer('id_data_jemaat');
            $table->rememberToken();
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
        Schema::dropIfExists('table_pengguna');
    }
};
