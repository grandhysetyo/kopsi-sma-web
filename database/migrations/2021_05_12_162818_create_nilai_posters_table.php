<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_posters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aspek_id');
            $table->foreign('aspek_id')->references('id')->on('aspek_nilai_posters')->onDelete('cascade');
            $table->unsignedBigInteger('seleksi_id');
            $table->foreign('seleksi_id')->references('id')->on('juri_nilai_posters')->onDelete('cascade');
            $table->integer('nilai');
            $table->double('nilai_akhir');
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
        Schema::dropIfExists('nilai_posters');
    }
}
