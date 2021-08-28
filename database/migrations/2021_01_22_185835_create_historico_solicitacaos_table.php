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
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('lider_id');
            $table->unsignedBigInteger('tipo_solicitacao_id');
            $table->date('data_solicitacao');
            $table->date('data_realizacao')->nullable();
            $table->longText('comentario')->nullable();
            $table->timestamps();
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
