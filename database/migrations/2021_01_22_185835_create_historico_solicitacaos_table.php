<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_solicitacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('lider_id')->nullable();
            $table->unsignedBigInteger('tipo_solicitacao_id');
            $table->enum('status', ['AB', 'AG' ,'CL'])->default('AB');  //AB->Abertas  AG->Agendadas  CL->Concluídas
            $table->datetime('data_agendamento')->nullable();
            $table->datetime('data_realizacao')->nullable();
            $table->longText('comentario')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('lider_id')->references('id')->on('membros');
            $table->foreign('tipo_solicitacao_id')->references('id')->on('tipo_solicitacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_solicitacaos');
    }
}
