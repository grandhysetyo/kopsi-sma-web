<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi_anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tempat');
            $table->date('waktu');
            $table->string('penyelenggara');
            $table->string('prestasi');
            $table->unsignedBigInteger('anggota_id')->nullable();
            $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('cascade');
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
        Schema::dropIfExists('prestasi_anggotas');
    }
}
