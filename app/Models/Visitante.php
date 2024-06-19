<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visitante extends Model
{
    use HasFactory;

    protected $fillable = [
            'nome', 'end_cep', 'end_cidade', 'end_uf', 'end_logradouro', 'end_numero',
            'end_bairro', 'end_complemento', 'celular', 'data_nascimento', 'sexo', 
            'email', 'status', 'tipo_visitante', 'redes_sociais', 'igreja_frequenta'
    ];

    public function membro()
    {
        return $this->belongsTo('App\Models\Membro');
    }

    public function lider()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function ficha_visitantes()
    {
        return $this->hasMany('App\Models\FichaVisitante');
    }    

    public function getDataNascimentoAjustadaAttribute()
    {
        return ($this->data_nascimento) ? date('Y-m-d', strtotime($this->data_nascimento)): '';
    }

    public function getDataNascimentoFormatadaAttribute()
    {
        return ($this->data_nascimento) ? date('d/m/Y', strtotime($this->data_nascimento)): '';
    }

    public function getDataSolicitacaoAttribute()
    {
        return ($this->created_at) ? date('d-m-Y H:i', strtotime($this->created_at)): '';
    }

    public function getDataSolicitacaoOrdenacaoAttribute()
    {
        return ($this->created_at) ? date('YmdHis', strtotime($this->created_at)) : '30000101';
    }


    // public function getDataNascimentoDiaMesAttribute()
    // {
    //     setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    //     date_default_timezone_set('America/Sao_Paulo');

    //     if($this->data_nascimento){

    //         $now = Carbon::now();

    //         $nascimento = Carbon::createFromFormat('Y-m-d',  $this->data_nascimento);

    //         $dia_atual = Carbon::createFromFormat('Y-m-d',  $now->year . '-' . $nascimento->month . '-' . $nascimento->day);

    //         $dia_semana = strftime('%a', strtotime($dia_atual));

    //         return $nascimento->day . '/' . ucfirst($dia_semana);

    //     } else {
    //         return '';
    //     }
    // }


    // public function getIdadeAttribute()
    // {
    //     return ($this->data_nascimento) ? Carbon::parse($this->data_nascimento)->age . ' anos': '';
    // }


    public function getRedesTextoAttribute(){

        $descricao = '';

        switch($this->redes_sociais){

            case 'S' : {
                $descricao = 'Sim';
                break;
            }
            case 'N' : {
                $descricao = 'Não';
                break;
            }
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }

    public function getSexoTextoAttribute(){

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


    public function getStatusTextoAttribute(){

        $descricao = '';

        switch($this->status){

            case 'AB' : {
                $descricao = 'Aberta Site';
                break;
            }
            case 'RL' : {
                $descricao = 'Repassada Líder';
                break;
            }
            case 'IL' : {
                $descricao = 'Iniciada Líder';
                break;
            }
            case 'FL' : {
                $descricao = 'Finalizada Líder';
                break;
            }                        
            default : {
                $descricao = '---';
                break;
            }
        }

        return $descricao;
    }

    public function getTipoTextoAttribute(){

        $descricao = '';

        switch($this->tipo_visitante){

            case 'RS' : {
                $descricao = 'Residente';
                break;
            }
            case 'EM' : {
                $descricao = 'Em Mudança';
                break;
            }
            case 'NR' : {
                $descricao = 'Não Residente';
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

