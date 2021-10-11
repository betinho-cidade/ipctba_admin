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
        ];
    }

    public function messages()
    {
        return [
            'tipo_solicitacao.required' => 'O Tipo de Solicitação é requerido',
            'lider.required' => 'O Líder é requerido',
            'data_agendamento.required' => 'A Data de Agendamento é requerida',
            'data_agendamento.date' => 'A Data de Agendamento é inválida',
        ];
    }
}
