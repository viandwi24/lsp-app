<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrMak01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fr_mak_01', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('skema_id')->unsigned();
            $table->boolean('bukti_tl')->default(false);
            $table->boolean('bukti_l')->default(false);
            $table->boolean('bukti_t')->default(false);
            $table->timestamps();

            $table->foreign('skema_id')->references('id')->on('skema')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fr_mak_01');
    }
}
