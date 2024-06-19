<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaVisitanteProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_visitante_processos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ficha_visitante_id');
            $table->unsignedBigInteger('processo_visitante_id');
            $table->datetime('data_processo');
            $table->string('anotacao', 300)->nullable();
            $table->timestamps();
            $table->foreign('ficha_visitante_id')->references('id')->on('ficha_visitantes');
            $table->foreign('processo_visitante_id')->references('id')->on('processo_visitantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_visitante_processos');
    }
}
