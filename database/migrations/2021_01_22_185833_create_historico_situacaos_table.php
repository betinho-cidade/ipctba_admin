<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoSituacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_situacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('situacao_membro_id');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->longText('comentario')->nullable();
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('situacao_membro_id')->references('id')->on('situacao_membros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_situacaos');
    }
}
