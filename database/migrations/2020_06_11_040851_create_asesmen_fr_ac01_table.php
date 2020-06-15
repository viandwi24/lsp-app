<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesmenFrAc01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesmen_frac01', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asesmen_id')->unsigned();
            $table->foreign('asesmen_id')->references('id')->on('asesmen')->onUpdate('cascade')->onDelete('cascade');

            $table->json('bukti')->default(new Expression('(JSON_ARRAY())'));
            $table->json('skema')->default(new Expression('(JSON_OBJECT())'));
            $table->longText('tindak_lanjut')->nullable();
            $table->longText('komentar')->nullable();
            $table->enum('keputusan', ['kompeten', 'belum_kompeten']);

            $table->timestamp('signed_asesi_at')->nullable();
            $table->timestamp('signed_asesor_at')->nullable();

            $table->timestamp('mulai');
            $table->timestamp('selesai');
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
        Schema::dropIfExists('asesmen_frac01');
    }
}
