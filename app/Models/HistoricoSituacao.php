<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class HistoricoSituacao extends Model
{
    use HasFactory;

    public function membro(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function situacao_membro(){

        return $this->belongsTo('App\Models\SituacaoMembro');
    }

    public function getDataInicioFormatadaAttribute()
    {
        return ($this->data_inicio) ? date('d-m-Y', strtotime($this->data_inicio)): '';
    }

    public function getDataInicioAjustadaAttribute()
    {
        return ($this->data_inicio) ? date('Y-m-d', strtotime($this->data_inicio)) : '';
    }

    public function getDataFimFormatadaAttribute()
    {
        return ($this->data_fim) ? date('d-m-Y', strtotime($this->data_fim)): '';
    }

    public function getDataFimAjustadaAttribute()
    {
        return ($this->data_fim) ? date('Y-m-d', strtotime($this->data_fim)) : '';
    }

    public function getDataFimOrdenacaoAttribute()
    {
        return ($this->data_fim) ? date('Ymd', strtotime($this->data_fim)) : '30000101';
    }

    public function getComentarioAbreviadoAttribute()
    {
        return ($this->comentario) ? Str::limit($this->comentario, 50, '...') : '';
    }

}

