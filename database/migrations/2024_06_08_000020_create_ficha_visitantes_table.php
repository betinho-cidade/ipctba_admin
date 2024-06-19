<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_visitantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('visitante_id');
            $table->unsignedBigInteger('solicitacao_visitante_id');
            $table->string('motivo', 300)->nullable();
            $table->timestamps();
            $table->foreign('visitante_id')->references('id')->on('visitantes');
            $table->foreign('solicitacao_visitante_id')->references('id')->on('solicitacao_visitantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_visitantes');
    }
}
