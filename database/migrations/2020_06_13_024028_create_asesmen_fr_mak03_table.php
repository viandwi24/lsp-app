<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesmenFrMak03Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesmen_frmak03', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asesmen_id')->unsigned();
            $table->foreign('asesmen_id')->references('id')->on('asesmen')->onUpdate('cascade')->onDelete('cascade');

            $table->json('unit')->default(new Expression('(JSON_ARRAY())'));
            $table->boolean('dijelaskan');
            $table->boolean('diskusi');
            $table->boolean('orang_lain');
            $table->longText('alasan');
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
        Schema::dropIfExists('asesmen_frmak03');
    }
}
