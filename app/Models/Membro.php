<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function local_congrega(){

        return $this->hasMany('App\Models\LocalCongrega');
    }

    public function meio_admissao(){

        return $this->hasMany('App\Models\MeioAdmissao');
    }

    public function meio_demissao(){

        return $this->hasMany('App\Models\MeioDemissao');
    }

    public function oficio(){

        return $this->hasMany('App\Models\Oficio');
    }

    public function situacao_membro(){

        return $this->hasMany('App\Models\SituacaoMembro');
    }

}

