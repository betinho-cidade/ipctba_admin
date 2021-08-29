<?php

namespace App\Http\Requests\Cadastro\Membro\HistoricoSolicitacao;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lider' => 'required',
            'data_realizacao' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'lider.required' => 'O Líder é requerido',
            'data_realizacao.date' => 'A Data Realização é inválida',
        ];
    }

}
