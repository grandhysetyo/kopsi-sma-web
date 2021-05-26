<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembimbings', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('nip')->nullable();
            $table->string('jalan')->nullable();
            $table->string('no_rmh')->nullable();
            $table->string('rt_rw')->nullable();
            $table->char('kelurahan_id', 10)->nullable();
            $table->foreign('kelurahan_id')->references('id')->on('villages')->onDelete('cascade');
            $table->integer('kodepos')->nullable();
            $table->unsignedBigInteger('tim_id')->nullable();
            $table->foreign('tim_id')->references('id')->on('tims')->onDelete('cascade');
            $table->text('surat_kepsek')->nullable();
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
        Schema::dropIfExists('pembimbings');
    }
}
