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
            'repetir_solicitacao' => 'required_with:data_realizacao',
        ];
    }

    public function messages()
    {
        return [
            'lider.required' => 'O Líder é requerido',
            'data_realizacao.date' => 'A Data Realização é inválida',
            'repetir_solicitacao.required_with' => 'O campo Repetir Soliticação deve ser preenchido se a Data de Realização for preenchida',
        ];
    }

}
