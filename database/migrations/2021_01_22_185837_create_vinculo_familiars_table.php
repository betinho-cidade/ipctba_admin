<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculoFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculo_familiars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('vinculo_id');
            $table->enum('tipo_vinculo', ['P', 'M', 'F', 'I']);  //P->Pai  M->Mãe  F->Filho  I->Irmão
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('vinculo_id')->references('id')->on('membros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vinculo_familiars');
    }
}
