<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesiSkemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesi_skema', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permohonan_id')->unsigned();
            $table->foreign('permohonan_id')->references('id')->on('permohonan')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('skema_id')->unsigned();
            $table->foreign('skema_id')->references('id')->on('skema')->onUpdate('cascade')->onDelete('cascade');
            
            $table->bigInteger('asesi_id')->unsigned();
            $table->foreign('asesi_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('asesor_id')->unsigned();
            $table->foreign('asesor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('keputusan', ['kompeten', 'belum_kompeten'])->nullable()->default(null);
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
        Schema::dropIfExists('skema_asesi');
    }
}
