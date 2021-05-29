<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPengumumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_pengumumen', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->tinyInteger('type');
            $table->text('berkas')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('info_id');
            $table->foreign('info_id')->references('id')->on('infos')->onDelete('cascade');
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
        Schema::dropIfExists('berkas_pengumumen');
    }
}
