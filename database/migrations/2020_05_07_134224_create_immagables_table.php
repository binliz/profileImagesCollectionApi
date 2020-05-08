<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmagablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immagables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->morphs('immagable');
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
        Schema::dropIfExists('immagables');
    }
}
