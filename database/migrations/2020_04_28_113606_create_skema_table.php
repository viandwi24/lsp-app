<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateSkemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skema', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned();
            $table->string('judul');
            $table->string('kode');
            $table->json('unit')//->default(new Expression('(JSON_ARRAY())'));
            ->default('[]');
            $table->json('berkas')//->default(new Expression('(JSON_ARRAY())'));
            ->default('[]');
            $table->boolean('aktif')->default(true);
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skema');
    }
}
