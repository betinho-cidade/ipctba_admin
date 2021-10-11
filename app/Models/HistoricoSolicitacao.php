<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class HistoricoSolicitacao extends Model
{
    use HasFactory;

    public function membro(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function lider(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function tipo_solicitacao(){

        return $this->belongsTo('App\Models\TipoSolicitacao');
    }

    public function getDataAgendamentoFormatadaAttribute()
    {
        return ($this->data_agendamento) ? date('d-m-Y', strtotime($this->data_agendamento)): '';
    }

    public function getDataAgendamentoAjustadaAttribute()
    {
        return ($this->data_agendamento) ? date('Y-m-d', strtotime($this->data_agendamento)) : '';
    }

    public function getDataRealizacaoFormatadaAttribute()
    {
        return ($this->data_realizacao) ? date('d-m-Y', strtotime($this->data_realizacao)): '';
    }

    public function getDataRealizacaoAjustadaAttribute()
    {
        return ($this->data_realizacao) ? date('Y-m-d', strtotime($this->data_realizacao)) : '';
    }

    public function getDataRealizacaoOrdenacaoAttribute()
    {
        return ($this->data_realizacao) ? date('Ymd', strtotime($this->data_realizacao)) : '30000101';
    }

    public function getComentarioAbreviadoAttribute()
    {
        return ($this->comentario) ? Str::limit($this->comentario, 50, '...') : '';
    }

}

