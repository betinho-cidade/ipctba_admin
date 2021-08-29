<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class MembroFamilia extends Model
{
    use HasFactory;

    public function membro(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function membro_familia(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function getVinculoFamiliarAttribute(){

        $vinculo = '';

        switch($this->vinculo){

            case 'P' : {
                $vinculo = 'Pai';
                break;
            }
            case 'M' : {
                $vinculo = 'Mãe';
                break;
            }
            case 'F' : {
                $vinculo = 'Filho(a)';
                break;
            }
            case 'C' : {
                $vinculo = 'Cônjuge';
                break;
            }
            default : {
                $vinculo = '---';
                break;
            }
        }

        return $vinculo;
    }

}

