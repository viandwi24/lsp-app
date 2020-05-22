<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanBerkasPersyaratanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_berkas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->bigInteger('permohonan_id')->unsigned();
            $table->bigInteger('berkas_id')->unsigned();
            $table->foreign('permohonan_id')->references('id')->on('permohonan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('berkas_id')->references('id')->on('berkas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('permohonan_berkas');
    }
}
