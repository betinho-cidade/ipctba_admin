<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembroMinisterio extends Model
{
    use HasFactory;

    public function membro()
    {
        return $this->belongsTo('App\Model\Membro');
    }

    public function ministerio()
    {
        return $this->belongsTo('App\Model\Ministerio');
    }

}

