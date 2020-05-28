<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesmenFrai02Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesmen_frai02', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asesmen_id')->unsigned();
            $table->foreign('asesmen_id')->references('id')->on('asesmen')->onUpdate('cascade')->onDelete('cascade');

            $table->json('data')->default(new Expression('(JSON_ARRAY())'));
            $table->enum('pengetahuan', ['memuaskan', 'tidak_memuaskan'])->default('memuaskan');
            $table->longText('catatan')->nullable();

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
        Schema::dropIfExists('asesmen_frai02');
    }
}
