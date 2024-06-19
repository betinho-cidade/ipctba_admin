<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id')->nullable(); // ID do membro quando ele se tornar um
            $table->unsignedBigInteger('lider_id')->nullable(); // Lider atribuido para o acompanhamento do visitante
            $table->enum('status', ['AB', 'RL', 'FL']);  //AB->Aberta  RL->Repassada Lider  IL->Iniciada Lider  FL->Finalizada Lider
            $table->enum('tipo_visitante', ['RS', 'EM' ,'NR'])->nullable();  //RS->Residente  EM->Em Mudança  NR->Não Residente
            $table->enum('redes_sociais', ['S', 'N'])->nullable();  //S->Permite contato por redes sociais    N->Não permite contato por redes sociais
            $table->string('nome', 300);
            $table->string('celular', 11);
            $table->string('email_visitante', 500)->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();  //M->Masculino   F->Feminino
            $table->date('data_nascimento')->nullable();
            $table->string('end_cep', 8)->nullable();
            $table->string('end_cidade', 60)->nullable();
            $table->string('end_uf', 2)->nullable();;
            $table->string('end_logradouro', 80)->nullable();
            $table->string('end_numero', 20)->nullable();
            $table->string('end_bairro', 60)->nullable();
            $table->string('end_complemento', 40)->nullable();
            $table->string('igreja_frequenta', 300)->nullable();
            $table->string('igreja_cidade', 150)->nullable();
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
            $table->foreign('lider_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitantes');
    }
}
