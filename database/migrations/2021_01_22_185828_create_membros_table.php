<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('local_congrega_id')->nullable();
            $table->unsignedBigInteger('meio_admissao_id')->nullable();
            $table->unsignedBigInteger('meio_demissao_id')->nullable();
            $table->unsignedBigInteger('situacao_membro_id')->nullable();
            $table->string('nome', 300);
            $table->string('end_cep', 8)->nullable();
            $table->string('end_cidade', 60)->nullable();
            $table->string('end_uf', 2)->nullable();;
            $table->string('end_logradouro', 80)->nullable();
            $table->string('end_numero', 20)->nullable();
            $table->string('end_bairro', 60)->nullable();
            $table->string('end_complemento', 40)->nullable();
            $table->string('path_imagem', 300)->nullable();
            $table->string('celular', 11);
            $table->string('email', 500)->nullable();
            $table->date('data_nascimento');
            $table->string('naturalidade', 300);
            $table->enum('sexo', ['M', 'F']);  //M->Masculino   F->Feminino
            $table->string('cpf', 11)->nullable();
            $table->enum('estado_civil', ['SL', 'CS' ,'SP', 'DV', 'VI', 'UE'])->nullable();  //SL->Solteiro  CS->Casado  SP->Separado  DV->Divorciado  VI->Viúvo  UE->União Estável
            $table->string('conjuge', 300)->nullable();
            $table->date('data_casamento')->nullable();
            $table->enum('escolaridade', ['EF', 'EM' ,'EP', 'ES', 'MS', 'DO', 'PD', 'NA', 'AL', 'NI'])->nullable();  //EF->Ensino Fundamental  EM->Ensino Médio  EP->Ensino Profissionalizante  ES->Ensino Superior  MS->Mestrado  DO->Doutorado  PD->Pós Doutorado  NA->Não Alfbetizado  AL->Alfabetizado  NI->Não Informado
            $table->string('profissao', 300)->nullable();
            $table->string('nome_pai', 300)->nullable();
            $table->string('nome_mae', 300);
            $table->string('numero_rol', 50)->unique('membro_rol_uk')->nullable();
            $table->enum('tipo_membro', ['CM', 'NC', 'NM']);  //CM->Comungante  NC->Não Comungante  NM->Não Membro
            $table->date('data_batismo')->nullable();
            $table->string('pastor_batismo', 300)->nullable();
            $table->string('igreja_batismo', 300)->nullable();
            $table->date('data_profissao_fe')->nullable();
            $table->string('pastor_profissao_fe', 300)->nullable();
            $table->string('igreja_profissao_fe', 300)->nullable();
            $table->string('numero_ata', 50)->nullable();
            $table->date('data_admissao')->nullable();
            $table->date('data_demissao')->nullable();
            $table->enum('status', ['A', 'I']);  //A->Ativo  I->Inativo
            $table->enum('is_disciplina', ['S', 'N']);  //S->Sim  N->Não
            $table->enum('is_pastor', ['S', 'N']);  //S->Sim  N->Não
            $table->longText('aptidao')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('local_congrega_id')->references('id')->on('local_congregas');
            $table->foreign('meio_admissao_id')->references('id')->on('meio_admissaos');
            $table->foreign('meio_demissao_id')->references('id')->on('meio_demissaos');
            $table->foreign('oficio_id')->references('id')->on('oficios');
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
        Schema::dropIfExists('membros');
    }
}
