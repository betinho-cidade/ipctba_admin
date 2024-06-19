<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaoVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_visitantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 500);
            $table->enum('origem', ['ES', 'GR']);  //ES->Específica   GR->Geral
            $table->enum('informar_motivo', ['S', 'N'])->default('N');  //S->Sim N->Não
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
        Schema::dropIfExists('solicitacao_visitantes');
    }
}
