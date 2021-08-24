<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembroMinisteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membro_ministerios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('ministerio_id');
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('ministerio_id')->references('id')->on('ministerios');
            $table->unique(['membro_id', 'ministerio_id'], 'membro_ministerio_uk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membro_ministerios');
    }
}
