<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoOficiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_oficios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('oficio_id');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->longText('comentario')->nullable();
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('oficio_id')->references('id')->on('oficios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_oficios');
    }
}
