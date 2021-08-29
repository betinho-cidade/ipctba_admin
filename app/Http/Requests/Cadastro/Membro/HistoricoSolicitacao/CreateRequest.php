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
            'data_solicitacao' => 'required|date',
            'data_realizacao' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'tipo_solicitacao.required' => 'O Tipo de Solicitação é requerido',
            'lider.required' => 'O Líder é requerido',
            'data_solicitacao.required' => 'A Data Solicitação é requerida',
            'data_solicitacao.date' => 'A Data Solicitação é inválida',
            'data_realizacao.date' => 'A Data Realização é inválida',
        ];
    }
}
