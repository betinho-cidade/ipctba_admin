<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    use HasFactory;

    public function membro_ministerios(){

        return $this->hasMany('App\Models\MembroMinisterio');
    }

}

