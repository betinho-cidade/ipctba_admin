<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    use HasFactory;

    public function historico_oficios(){

        return $this->hasMany('App\Models\HistoricoOficio');
    }

}

