<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FichaVisitanteProcesso extends Model
{
    use HasFactory;

    public function ficha_visitante()
    {
        return $this->belongsTo('App\Models\FichaVisitante');
    }

    public function processo_visitante()
    {
        return $this->belongsTo('App\Models\ProcessoVisitante');
    }   
    
    public function getDataProcessoFormatadaAttribute()
    {
        return ($this->data_processo) ? date('d-m-Y H:i', strtotime($this->data_processo)): '';
    }    
}

