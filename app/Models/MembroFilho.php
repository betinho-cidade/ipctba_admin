<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class MembroFilho extends Model
{
    use HasFactory;

    public function membro(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function getDescricaoSexoAttribute(){

        $descricao = '';

        switch($this->sexo){

            case 'M' : {
                $descricao = 'Masculino';
                break;
            }
            case 'F' : {
                $descricao = 'Feminino';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }

    public function getDataNascimentoFormatadaAttribute()
    {
        return ($this->data_nascimento) ? date('d-m-Y', strtotime($this->data_nascimento)): '';
    }

    public function getDataNascimentoAjustadaAttribute()
    {
        return ($this->data_nascimento) ? date('Y-m-d', strtotime($this->data_nascimento)) : '';
    }

}

