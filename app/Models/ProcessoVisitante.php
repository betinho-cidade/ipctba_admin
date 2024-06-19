<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessoVisitante extends Model
{
    use HasFactory;

    public function solicitacao_visitante()
    {
        return $this->belongsTo('App\Models\SolicitacaoVisitante');
    }    

    public function ficha_visitante_processos()
    {
        return $this->hasMany('App\Models\FichaVisitanteProcesso');
    }       
}
