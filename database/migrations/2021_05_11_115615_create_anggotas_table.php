<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('kip')->nullable();
            $table->string('nik')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nohp')->nullable();
            $table->integer('kelas')->nullable();
            $table->string('ukuran_baju')->nullable();
            $table->string('jalan')->nullable();
            $table->string('no_rmh')->nullable();
            $table->string('rt_rw')->nullable();
            $table->integer('kodepos')->nullable();
            $table->char('kelurahan_id', 10);
            $table->foreign('kelurahan_id')->references('id')->on('villages')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tim_id');
            $table->foreign('tim_id')->references('id')->on('tims')->onDelete('cascade');
            $table->text('foto')->nullable();
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
        Schema::dropIfExists('anggotas');
    }
}
