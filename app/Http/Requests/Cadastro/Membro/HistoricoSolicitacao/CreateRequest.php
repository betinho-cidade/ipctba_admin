<?php

namespace App\Http\Requests\Cadastro\Membro\HistoricoSolicitacao;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo_solicitacao' => 'required',
            'lider' => 'required',
            'data_agendamento' => 'nullable|required_with:hora_agendamento|date',
            'hora_agendamento' => 'required_with:data_agendamento',


        ];
    }

    public function messages()
    {
        return [
            'tipo_solicitacao.required' => 'O Tipo de Solicitação é requerido',
            'lider.required' => 'O Líder é requerido',
            'data_agendamento.date' => 'A Data Realização é inválida',
            'data_agendamento.required_with' => 'A Data de Agendamento é requerida com a Hora de Agendamento',
            'hora_agendamento.required_with' => 'A Hora de Agendamento é requerida com a Data de Agendamento',


        ];
    }
}
