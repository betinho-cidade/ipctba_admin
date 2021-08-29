<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitacao extends Model
{
    use HasFactory;

    public function historico_solicitacaos(){

        return $this->hasMany('App\Models\HistoricoSolicitacao');
    }

}

