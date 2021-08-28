<?php

namespace App\Http\Requests\Cadastro\Membro\HistoricoOficio;

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
            'oficio' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'oficio.required' => 'O Ofício é requerido',
            'data_inicio.required' => 'A Data Início é requerida',
            'data_inicio.date' => 'A Data Início é inválida',
            'data_fim.date' => 'A Data Fim é inválida',
        ];
    }
}
