<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkemaTukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skema_tuk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('skema_id')->unsigned();
            $table->foreign('skema_id')->references('id')->on('skema')->onUpdate('cascade')->onDelete('cascade');
            
            $table->bigInteger('tuk_id')->unsigned();
            $table->foreign('tuk_id')->references('id')->on('tuk')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('skema_tuk');
    }
}
