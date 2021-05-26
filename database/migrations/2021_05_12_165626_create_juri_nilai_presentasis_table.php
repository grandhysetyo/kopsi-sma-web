<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuriNilaiPresentasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juri_nilai_presentasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presentasi_id');
            $table->foreign('presentasi_id')->references('id')->on('presentasis')->onDelete('cascade');
            $table->unsignedBigInteger('juri_id');
            $table->foreign('juri_id')->references('id')->on('juris')->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('juri_nilai_presentasis');
    }
}
