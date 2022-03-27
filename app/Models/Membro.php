<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membro extends Model
{
    use HasFactory;

    protected $fillable = [
            'nome', 'end_cep', 'end_cidade', 'end_uf', 'end_logradouro', 'end_numero',
            'end_bairro', 'end_complemento', 'celular', 'data_nascimento', 'naturalidade',
            'sexo', 'estado_civil', 'conjuge', 'data_casamento', 'profissao', 'nome_pai',
            'nome_mae', 'numero_rol', 'tipo_membro', 'numero_ata', 'data_admissao', 'status',
            'status_participacao_id', 'meio_admissao_id', 'igreja_old_nome', 'data_profissao_fe',
            'email', 'is_disciplina'
    ];



    public function getBreadcrumbAttribute()
    {
        $membro = $this->id;

        $bread = '<a href="' . route('relatorio.index') . '">Filtro Membros</a>';
        $bread .= ' > ';
        $bread .= '<a href="' . route('membro.show', compact('membro')) . '">' . $this->nome . '</a>';

        return $bread;
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function status_participacao(){

        return $this->belongsTo('App\Models\StatusParticipacao');
    }

    public function meio_admissao(){

        return $this->belongsTo('App\Models\MeioAdmissao');
    }

    public function meio_demissao(){

        return $this->belongsTo('App\Models\MeioDemissao');
    }

   public function membro_ministerios(){

        return $this->hasMany('App\Models\MembroMinisterio');
    }

    public function ministerios_ids(){

        return $this->membro_ministerios()
                    ->pluck('ministerio_id')
                    ->toArray();
    }

    public function getMinisteriosListaAttribute(){

        $lista = '';

        foreach($this->membro_ministerios()->get() as $ministerio){
            $lista .= $ministerio->ministerio->nome . ', ';
        }

        return rtrim($lista,', ');;
    }

    public function historico_situacaos(){

        return $this->hasMany('App\Models\HistoricoSituacao');
    }

    public function getHistoricoSituacaoAtualAttribute(){

        $historico_atual = $this->historico_situacaos()
                                ->whereNull('data_fim')
                                ->first();

        return ($historico_atual) ? $historico_atual->situacao_membro->nome : ' --- ';
    }


    public function historico_oficios(){

        return $this->hasMany('App\Models\HistoricoOficio');
    }


    public function getHistoricoOficioAtualAttribute(){

        $historico_atual = $this->historico_oficios()
                                ->whereNull('data_fim')
                                ->first();

        return ($historico_atual) ? $historico_atual->oficio->nome : ' --- ';
    }


    public function historico_solicitacaos(){

        return $this->hasMany('App\Models\HistoricoSolicitacao');
    }

    public function getHistoricoSolicitacaoListaAttribute(){

        $lista = '';

        foreach($this->historico_solicitacaos()->orderBy('data_agendamento')->get() as $historico_solicitacao){
            $lista .= $historico_solicitacao->tipo_solicitacao->nome . ' ['.$historico_solicitacao->data_agendamento_formatada.' - '.$historico_solicitacao->data_realizacao_formatada.'], ';
        }

        return rtrim($lista,', ');;
    }

    public function membro_fichas(){

        return $this->hasMany('App\Models\MembroFicha');
    }


    public function membro_familias(){

        return $this->hasMany('App\Models\MembroFamilia');
    }


    public function membro_filhos(){

        return $this->hasMany('App\Models\MembroFilho');
    }

    public function getImagemAttribute()
    {
        return ($this->path_imagem) ? asset('images/avatar/'.$this->path_imagem) : asset('images/avatar/avatar.png');
    }


    public function getDataCasamentoAjustadaAttribute()
    {
        return ($this->data_casamento) ? date('Y-m-d', strtotime($this->data_casamento)): '';
    }

    public function getDataCasamentoFormatadaAttribute()
    {
        return ($this->data_casamento) ? date('d/m/Y', strtotime($this->data_casamento)): '';
    }

    public function getDataNascimentoAjustadaAttribute()
    {
        return ($this->data_nascimento) ? date('Y-m-d', strtotime($this->data_nascimento)): '';
    }

    public function getDataNascimentoFormatadaAttribute()
    {
        return ($this->data_nascimento) ? date('d/m/Y', strtotime($this->data_nascimento)): '';
    }

    public function getDataNascimentoDiaMesAttribute()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        if($this->data_nascimento){

            $now = Carbon::now();

            $nascimento = Carbon::createFromFormat('Y-m-d',  $this->data_nascimento);

            $dia_atual = Carbon::createFromFormat('Y-m-d',  $now->year . '-' . $nascimento->month . '-' . $nascimento->day);

            $dia_semana = strftime('%a', strtotime($dia_atual));

            return $nascimento->day . '/' . ucfirst($dia_semana);

        } else {
            return '';
        }
    }


    public function getIdadeAttribute()
    {
        return ($this->data_nascimento) ? Carbon::parse($this->data_nascimento)->age . ' anos': '';
    }


    public function getDataBatismoAjustadaAttribute()
    {
        return ($this->data_batismo) ? date('Y-m-d', strtotime($this->data_batismo)): '';
    }

    public function getDataBatismoFormatadaAttribute()
    {
        return ($this->data_batismo) ? date('d/m/Y', strtotime($this->data_batismo)): '';
    }

    public function getDataProfissaoFeAjustadaAttribute()
    {
        return ($this->data_profissao_fe) ? date('Y-m-d', strtotime($this->data_profissao_fe)): '';
    }

    public function getDataProfissaoFeFormatadaAttribute()
    {
        return ($this->data_profissao_fe) ? date('d/m/Y', strtotime($this->data_profissao_fe)): '';
    }

    public function getDataAdmissaoAjustadaAttribute()
    {
        return ($this->data_admissao) ? date('Y-m-d', strtotime($this->data_admissao)): '';
    }

    public function getDataAdmissaoFormatadaAttribute()
    {
        return ($this->data_admissao) ? date('d/m/Y', strtotime($this->data_admissao)): '';
    }

    public function getDataDemissaoAjustadaAttribute()
    {
        return ($this->data_demissao) ? date('Y-m-d', strtotime($this->data_demissao)): '';
    }

    public function getDataDemissaoFormatadaAttribute()
    {
        return ($this->data_demissao) ? date('d/m/Y', strtotime($this->data_demissao)): '';
    }

    public function getDescricaoSexoAttribute(){

        $descricao = '';

        switch($this->sexo){

            case 'M' : {
                $descricao = 'Masculino';
                break;
            }
            case 'F' : {
                $descricao = 'Feminino';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoEstadoCivilAttribute(){

        $descricao = '';

        switch($this->estado_civil){

            case 'SL' : {
                $descricao = 'Solteiro';
                break;
            }
            case 'CS' : {
                $descricao = 'Casado';
                break;
            }
            case 'SP' : {
                $descricao = 'Separado';
                break;
            }
            case 'DV' : {
                $descricao = 'Divorciado';
                break;
            }
            case 'VI' : {
                $descricao = 'Viúvo';
                break;
            }
            case 'UE' : {
                $descricao = 'União Estável';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoEscolaridadeAttribute(){

        $descricao = '';

        switch($this->escolaridade){

            case 'EF' : {
                $descricao = 'Ensino Fundamental';
                break;
            }
            case 'EM' : {
                $descricao = 'Ensino Médio';
                break;
            }
            case 'EP' : {
                $descricao = 'Ensino Profissionalizante';
                break;
            }
            case 'ES' : {
                $descricao = 'Ensino Superior';
                break;
            }
            case 'MS' : {
                $descricao = 'Mestrado';
                break;
            }
            case 'DO' : {
                $descricao = 'Doutorado';
                break;
            }
            case 'PD' : {
                $descricao = 'Pós Dutorado';
                break;
            }
            case 'NA' : {
                $descricao = 'Não Alfabetizado';
                break;
            }
            case 'AL' : {
                $descricao = 'Alfabetizado';
                break;
            }
            case 'NI' : {
                $descricao = 'Não Informada';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoTipoMembroAttribute(){

        $descricao = '';

        switch($this->tipo_membro){

            case 'CM' : {
                $descricao = 'Comungante';
                break;
            }
            case 'NC' : {
                $descricao = 'Não Comungante';
                break;
            }
            case 'NM' : {
                $descricao = 'Não Membro';
                break;
            }
            case 'PS' : {
                $descricao = 'Pastor';
                break;
            }
            case 'EP' : {
                $descricao = 'Em Processo';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoStatusAttribute(){

        $descricao = '';

        switch($this->status){

            case 'A' : {
                $descricao = 'Ativo';
                break;
            }
            case 'I' : {
                $descricao = 'Inativo';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoIsDisciplinaAttribute(){

        $descricao = '';

        switch($this->is_disciplina){

            case 'S' : {
                $descricao = 'Sim';
                break;
            }
            case 'N' : {
                $descricao = 'Não';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }

    public function getCadastroInicialAttribute()
    {

        $cadastro_inicial = false;

        $historico_oficio = ($this->historico_oficios->count() == 0) ? true : false;
        $historico_solicitacao = ($this->historico_solicitacaos->count() == 0) ? true : false;
        $membro_familia = ($this->membro_familias->count() == 0) ? true : false;
        $historico_situacao = ($this->historico_situacaos->count() <= 2) ? true : false; // SituacaoMembro: 1.Tempo de Igreja -  2.Cadastro Site

        if($historico_oficio && $historico_solicitacao
           && $membro_familia && $historico_situacao
           && $this->tipo_membro = 'EP'){
            $cadastro_inicial = true;
        }

        return $cadastro_inicial;
    }

}

