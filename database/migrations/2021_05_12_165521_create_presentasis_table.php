<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentasis', function (Blueprint $table) {
            $table->id();
            $table->integer('konfirmasi');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('tim_id');
            $table->foreign('tim_id')->references('id')->on('tims')->onDelete('cascade');
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
        Schema::dropIfExists('presentasis');
    }
}
