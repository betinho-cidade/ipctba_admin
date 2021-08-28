<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;


    public function getBreadcrumbAttribute()
    {
        $membro = $this->id;

        $bread = '<a href="' . route('membro.index') . '">Lista Membros</a>';
        $bread .= ' > ';
        $bread .= '<a href="' . route('membro.show', compact('membro')) . '">' . $this->nome . '</a>';

        return $bread;
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function local_congrega(){

        return $this->belongsTo('App\Models\LocalCongrega');
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

    public function historico_situacaos(){

        return $this->hasMany('App\Models\HistoricoSituacao');
    }

    public function historico_oficios(){

        return $this->hasMany('App\Models\HistoricoOficio');
    }

    public function getHistoricoSituacaoAtualAttribute(){

        $historico_atual = $this->historico_situacaos()
                                ->whereNull('data_fim')
                                ->first();

        return ($historico_atual) ? $historico_atual->situacao_membro->nome : ' --- ';
    }

    public function getHistoricoOficioAtualAttribute(){

        $historico_atual = $this->historico_oficios()
                                ->whereNull('data_fim')
                                ->first();

        return ($historico_atual) ? $historico_atual->oficio->nome : ' --- ';
    }

    public function getImagemAttribute()
    {
        return ($this->path_imagem) ? asset('images/avatar/'.$this->path_imagem) : asset('images/avatar/avatar.png');
    }


    public function getDataCasamentoAjustadaAttribute()
    {
        return ($this->data_casamento) ? date('Y-m-d', strtotime($this->data_casamento)): '';
    }


    public function getDataNascimentoAjustadaAttribute()
    {
        return ($this->data_nascimento) ? date('Y-m-d', strtotime($this->data_nascimento)): '';
    }


    public function getDataBatismoAjustadaAttribute()
    {
        return ($this->data_batismo) ? date('Y-m-d', strtotime($this->data_batismo)): '';
    }


    public function getDataProfissaoFeAjustadaAttribute()
    {
        return ($this->data_profissao_fe) ? date('Y-m-d', strtotime($this->data_profissao_fe)): '';
    }


    public function getDataAdmissaoAjustadaAttribute()
    {
        return ($this->data_admissao) ? date('Y-m-d', strtotime($this->data_admissao)): '';
    }


    public function getDataDemissaoAjustadaAttribute()
    {
        return ($this->data_demissao) ? date('Y-m-d', strtotime($this->data_demissao)): '';
    }

}

