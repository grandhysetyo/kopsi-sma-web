<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah')->nullable();
            $table->integer('npsn')->nullable();
            $table->string('telp_sekolah')->nullable();
            $table->string('status')->default('N');
            $table->char('kelurahan_id', 10)->nullable();
            $table->foreign('kelurahan_id')->references('id')->on('villages')->onDelete('cascade');
            $table->string('jalan')->nullable();
            $table->string('no_rmh')->nullable();
            $table->string('rt_rw')->nullable();
            $table->integer('kodepos')->nullable();
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
        Schema::dropIfExists('sekolahs');
    }
}
