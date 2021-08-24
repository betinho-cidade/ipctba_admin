<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeioAdmissao extends Model
{
    use HasFactory;

    public function membros(){

        return $this->hasMany('App\Models\Membro');
    }

}

