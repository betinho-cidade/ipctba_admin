<?php

namespace App\Http\Requests\Parametros\SolicitacaoVisitante;

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
            'nome' => 'required|max:500',
            'origem' => 'required',
            'informar_motivo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 500 caracteres',
            'origem.required' => 'A origem é requerida',
            'informar_motivo.required' => 'Informar se o motivo deve ser preenchido é requerido',
        ];
    }

}
