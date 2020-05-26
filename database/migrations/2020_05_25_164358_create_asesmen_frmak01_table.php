<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesmenFrmak01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesmen_frmak01', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('asesmen_id')->unsigned();
            $table->foreign('asesmen_id')->references('id')->on('asesmen')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('signed_asesi_at')->nullable();
            $table->timestamp('signed_asesor_at')->nullable();
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
        Schema::dropIfExists('asesmen_frmak01');
    }
}
