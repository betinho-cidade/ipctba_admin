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
            'data_agendamento' => 'required|date',
            'hora_agendamento' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tipo_solicitacao.required' => 'O Tipo de Solicitação é requerido',
            'lider.required' => 'O Líder é requerido',
            'data_agendamento.required' => 'A Data do Agendamento é requerida',
            'data_agendamento.date' => 'A Data do Agendamento é inválida',
            'hora_agendamento.required' => 'A Hora do Agendamento é requerida',
        ];
    }
}
