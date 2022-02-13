<?php

namespace App\Http\Requests\Cadastro\AgendaSolicitacao;

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
            'lider' => 'required_with:data_agendamento',
            'tipo_solicitacao' => 'required',
            'membro' => 'required',
            'data_agendamento' => 'nullable|required_with:hora_agendamento,lider|date',
            'hora_agendamento' => 'required_with:data_agendamento',
        ];
    }

    public function messages()
    {
        return [
            'lider.required_with' => 'O Líder é requerido com a Data de Agendamento',
            'tipo_solicitacao.required' => 'O Tipo de Solicitação é requerido',
            'membro.required' => 'O Membro é requerido',
            'data_agendamento.date' => 'A Data de Agendamento é inválida',
            'data_agendamento.required_with' => 'A Data de Agendamento é requerida com a Hora de Agendamento e com o Líder',
            'hora_agendamento.required_with' => 'A Hora de Agendamento é requerida com a Data de Agendamento',
        ];
    }
}
