<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembroFamiliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membro_familias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('membro_familia_id');
            $table->enum('vinculo', ['P', 'M', 'F', 'C']);  //P->Pai  M->Mãe  F->Filho  C->Cônjuge
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('membro_familia_id')->references('id')->on('membros');
            $table->unique(['membro_id', 'membro_familia_id', 'vinculo'], 'membro_familia_uk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membro_familias');
    }
}
