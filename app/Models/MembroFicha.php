<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembroFicha extends Model
{
    use HasFactory;

    public function getBreadcrumbAttribute()
    {
        $membro_ficha = $this->id;

        $bread = '<a href="' . route('membro_ficha.index') . '">Ficha de Atualização</a>';

        return $bread;
    }

    public function membro()
    {
        return $this->belongsTo('App\Models\Membro');
    }

    public function lider(){

        return $this->belongsTo('App\Models\Membro');
    }

    public function getDataCasamentoAjustadaAttribute()
    {
        return ($this->data_casamento) ? date('Y-m-d', strtotime($this->data_casamento)): '';
    }

    public function getDataCasamentoFormatadaAttribute()
    {
        return ($this->data_casamento) ? date('d-m-Y', strtotime($this->data_casamento)): '';
    }

    public function getDataNascimentoAjustadaAttribute()
    {
        return ($this->data_nascimento) ? date('Y-m-d', strtotime($this->data_nascimento)): '';
    }

    public function getDataNascimentoFormatadaAttribute()
    {
        return ($this->data_nascimento) ? date('d-m-Y', strtotime($this->data_nascimento)): '';
    }

    public function getDataSolicitacaoAttribute()
    {
        return ($this->created_at) ? date('d-m-Y', strtotime($this->created_at)): '';
    }

    public function getDataSolicitacaoOrdenacaoAttribute()
    {
        return ($this->created_at) ? date('Ymd', strtotime($this->created_at)) : '30000101';
    }


    public function getDescricaoEstadoCivilAttribute(){

        $descricao = '';

        switch($this->estado_civil){

            case 'SL' : {
                $descricao = 'Solteiro';
                break;
            }
            case 'CS' : {
                $descricao = 'Casado';
                break;
            }
            case 'SP' : {
                $descricao = 'Separado';
                break;
            }
            case 'DV' : {
                $descricao = 'Divorciado';
                break;
            }
            case 'VI' : {
                $descricao = 'Viúvo';
                break;
            }
            case 'UE' : {
                $descricao = 'União Estável';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoEscolaridadeAttribute(){

        $descricao = '';

        switch($this->escolaridade){

            case 'EF' : {
                $descricao = 'Ensino Fundamental';
                break;
            }
            case 'EM' : {
                $descricao = 'Ensino Médio';
                break;
            }
            case 'EP' : {
                $descricao = 'Ensino Profissionalizante';
                break;
            }
            case 'ES' : {
                $descricao = 'Ensino Superior';
                break;
            }
            case 'MS' : {
                $descricao = 'Mestrado';
                break;
            }
            case 'DO' : {
                $descricao = 'Doutorado';
                break;
            }
            case 'PD' : {
                $descricao = 'Pós Dutorado';
                break;
            }
            case 'NA' : {
                $descricao = 'Não Alfabetizado';
                break;
            }
            case 'AL' : {
                $descricao = 'Alfabetizado';
                break;
            }
            case 'NI' : {
                $descricao = 'Não Informada';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


    public function getDescricaoStatusAttribute(){

        $descricao = '';

        switch($this->status){

            case 'AS' : {
                $descricao = 'Ficha Aberta pelo Site';
                break;
            }
            case 'AL' : {
                $descricao = 'Ficha Aberta pelo Líder';
                break;
            }
            case 'C' : {
                $descricao = 'Ficha Concluida';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }


}

