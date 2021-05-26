<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeleksiNaskahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seleksi_naskahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('naskah_id');
            $table->foreign('naskah_id')->references('id')->on('naskahs')->onDelete('cascade');
            $table->unsignedBigInteger('juri_id');
            $table->foreign('juri_id')->references('id')->on('juris')->onDelete('cascade');
            $table->text('komentar')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('seleksi_naskahs');
    }
}
