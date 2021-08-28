<?php

namespace App\Http\Requests\Cadastro\Membro\HistoricoOficio;

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
            'data_fim' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'data_fim.date' => 'A Data Fim é inválida',
        ];
    }

}
