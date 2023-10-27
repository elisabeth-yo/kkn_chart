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
        Schema::create('model_has_benefits', function (Blueprint $table) {
            $table->unsignedBigInteger('benefit_id');

            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->foreign('benefit_id')
                ->references('id')
                ->on('benefits')
                ->onDelete('cascade');

            $table->primary(['benefit_id', 'model_id', 'model_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_benefits');
    }
};
