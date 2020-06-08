<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanAsesiAsesor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_asesi_asesor', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permohonan_id')->unsigned();
            $table->foreign('permohonan_id')->references('id')->on('permohonan')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('asesor_id')->unsigned();
            $table->foreign('asesor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->bigInteger('jadwal_id')->unsigned();
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onUpdate('cascade')->onDelete('cascade');
            
            $table->bigInteger('tuk_id')->unsigned();
            $table->foreign('tuk_id')->references('id')->on('tuk')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('approved_at')->nullable()->default(null);
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
        Schema::dropIfExists('permohonan_asesi_asesor');
    }
}
