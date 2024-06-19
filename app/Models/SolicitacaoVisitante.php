<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoVisitante extends Model
{
    use HasFactory;


    public function processo_visitantes(){

        return $this->hasMany('App\Models\ProcessoVisitante');
    }

    public function ficha_visitantes()
    {
        return $this->hasMany('App\Models\FichaVisitante');
    }        


    public function getOrigemTextoAttribute(){

        $origem = '';

        switch($this->origem){

            case 'GR' : {
                $origem = 'Geral';
                break;
            }
            case 'ES' : {
                $origem = 'Específica';
                break;
            }
            default : {
                $origem = '---';
                break;
            }
        }

        return $origem;
    }        

    public function getInformarMotivoTextoAttribute(){

        $informar_motivo = '';

        switch($this->informar_motivo){

            case 'S' : {
                $informar_motivo = 'Sim';
                break;
            }
            case 'N' : {
                $informar_motivo = 'Não';
                break;
            }
            default : {
                $informar_motivo = '---';
                break;
            }
        }

        return $informar_motivo;
    }    
}

