<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembroFichasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membro_fichas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id')->nullable();
            $table->unsignedBigInteger('lider_id')->nullable();
            $table->string('nome', 300)->nullable();
            $table->string('end_cep', 8)->nullable();
            $table->string('end_cidade', 60)->nullable();
            $table->string('end_uf', 2)->nullable();;
            $table->string('end_logradouro', 80)->nullable();
            $table->string('end_numero', 20)->nullable();
            $table->string('end_bairro', 60)->nullable();
            $table->string('end_complemento', 40)->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('email', 500)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('naturalidade', 300)->nullable();
            $table->enum('estado_civil', ['SL', 'CS' ,'SP', 'DV', 'VI', 'UE'])->nullable();  //SL->Solteiro  CS->Casado  SP->Separado  DV->Divorciado  VI->Viúvo  UE->União Estável
            $table->string('conjuge', 300)->nullable();
            $table->date('data_casamento')->nullable();
            $table->enum('escolaridade', ['EF', 'EM' ,'EP', 'ES', 'MS', 'DO', 'PD', 'NA', 'AL', 'NI'])->nullable();  //EF->Ensino Fundamental  EM->Ensino Médio  EP->Ensino Profissionalizante  ES->Ensino Superior  MS->Mestrado  DO->Doutorado  PD->Pós Doutorado  NA->Não Alfbetizado  AL->Alfabetizado  NI->Não Informado
            $table->string('profissao', 300)->nullable();
            $table->string('nome_pai', 300)->nullable();
            $table->string('nome_mae', 300)->nullable();
            $table->enum('status', ['AS', 'AL', 'C']);  //AS->Aberta Site  AL->Aberta Lidar  C->Concluida
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('lider_id')->references('id')->on('membros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membro_fichas');
    }
}
