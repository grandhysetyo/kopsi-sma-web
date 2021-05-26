<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tims', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tim')->nullable();
            $table->char('province_id', 2)->nullable();
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')->onDelete('cascade');
            $table->unsignedBigInteger('sekolah_id')->nullable();
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
            $table->unsignedBigInteger('bidang_id')->nullable();
            $table->foreign('bidang_id')->references('id')->on('sub_bidangs')->onDelete('cascade');
            $table->text('nama_karya')->nullable();
            $table->longText('deskripsi_karya')->nullable();
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
        Schema::dropIfExists('tims');
    }
}
