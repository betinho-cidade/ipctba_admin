<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;


class HistoricoSolicitacao extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    public function membro(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function lider(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function tipo_solicitacao(){

        return $this->belongsTo('App\Models\TipoSolicitacao');
    }


    public function getDataAgendamentoAnoMesFormatadaAttribute()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        return ($this->data_agendamento) ? utf8_encode(ucfirst(strftime('%B/%Y', strtotime($this->data_agendamento)))) : 'Aguardando Confirmação';
        // return ($this->data_agendamento) ? $formatter->format(date('F/Y', strtotime($this->data_agendamento))) : '';
    }

    public function getDataAgendamentoAgendaAttribute()
    {
        return ($this->data_agendamento) ? date('d/m H:i', strtotime($this->data_agendamento)) : '';
    }

    public function getDataAgendamentoAgendaAnoMesAttribute()
    {
        return ($this->data_agendamento) ? date('Ym', strtotime($this->data_agendamento)) : '';
    }

    public function getDataAgendamentoAjustadaAttribute()
    {
        return ($this->data_agendamento) ? date('Y-m-d', strtotime($this->data_agendamento)) : '';
    }

    public function getDataAgendamentoFormatadaAttribute()
    {
        return ($this->data_agendamento) ? date('d/m/y H:i', strtotime($this->data_agendamento)): '';
    }

    public function getHoraAgendamentoAjustadaAttribute()
    {
        return ($this->data_agendamento) ? date('H:i', strtotime($this->data_agendamento)) : '';
    }

    public function getDataAgendamentoOrdenacaoAttribute()
    {
        return ($this->data_agendamento) ? date('YmdHi', strtotime($this->data_agendamento)) : '3000010101';
    }

    public function getDataRealizacaoAjustadaAttribute()
    {
        return ($this->data_realizacao) ? date('Y-m-d', strtotime($this->data_realizacao)) : '';
    }

    public function getDataRealizacaoFormatadaAttribute()
    {
        return ($this->data_realizacao) ? date('d/m/y H:i', strtotime($this->data_realizacao)): '';
    }

    public function getHoraRealizacaoAjustadaAttribute()
    {
        return ($this->data_realizacao) ? date('H:i', strtotime($this->data_realizacao)) : '';
    }

    public function getDataRealizacaoOrdenacaoAttribute()
    {
        return ($this->data_realizacao) ? date('YmdHi', strtotime($this->data_realizacao)) : '3000010101';
    }

    public function getDataCriacaoOrdenacaoAttribute()
    {
        return ($this->created_at) ? date('YmdHi', strtotime($this->created_at)) : '3000010101';
    }

    public function getDataCriacaoFormatadaAttribute()
    {
        return ($this->created_at) ? date('d/m/y H:i', strtotime($this->created_at)): '';
    }


    public function getComentarioAbreviadoAttribute()
    {
        return ($this->comentario) ? Str::limit($this->comentario, 50, '...') : '';
    }

}

