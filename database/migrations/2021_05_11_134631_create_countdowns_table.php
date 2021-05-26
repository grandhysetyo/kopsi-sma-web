<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countdowns', function (Blueprint $table) {
            $table->id();
            $table->string('pendaftaran')->default('2020-12-24 23:59:59');
            $table->string('batas_unggah_proposal')->default('2020-12-24 23:59:59');
            $table->string('batas_unggah_naskah')->default('2020-12-24 23:59:59');
            $table->string('batas_unggah_youtube')->default('2020-12-24 23:59:59');
            $table->string('batas_unggah_poster')->default('2020-12-24 23:59:59');
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
        Schema::dropIfExists('countdowns');
    }
}
