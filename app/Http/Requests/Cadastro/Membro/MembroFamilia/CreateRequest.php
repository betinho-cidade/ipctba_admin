<?php

namespace App\Http\Requests\Cadastro\Membro\MembroFamilia;

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
            'membro_familia' => 'required',
            'vinculo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'membro_familia.required' => 'O Membro Familiar é requerido',
            'vinculo.required' => 'O Vínculo Familiar é requerido',
        ];
    }
}
