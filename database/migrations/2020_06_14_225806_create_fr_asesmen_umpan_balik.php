<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrAsesmenUmpanBalik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fr_asesmen_umpan_balik', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asesmen_id')->unsigned();            
            $table->json('data')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamps();
            
            $table->foreign('asesmen_id')->references('id')->on('asesmen')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fr_asesmen_umpan_balik');
    }
}
