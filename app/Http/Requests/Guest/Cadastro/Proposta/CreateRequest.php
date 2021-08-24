<?php

namespace App\Http\Requests\Guest\Cadastro\Proposta;

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
            'idioma' => 'required',
            'paise_EN' => 'required',
            'autor_EN' => 'required|max:500',
            'data_EN' => 'required|date',
            'titulo_EN' => 'required|max:500',
            'texto_EN' => 'required',
            'fundamentacao_EN' => 'required',
            'comentario_EN' => 'required',
            'email_EN' => 'required|max:500',
            'paise_DE' => 'required',
            'autor_DE' => 'required|max:500',
            'data_DE' => 'required|date',
            'titulo_DE' => 'required|max:500',
            'texto_DE' => 'required',
            'fundamentacao_DE' => 'required',
            'comentario_DE' => 'required',
            'email_DE' => 'required|max:500',
            'paise_ES' => 'required',
            'autor_ES' => 'required|max:500',
            'data_ES' => 'required|date',
            'titulo_ES' => 'required|max:500',
            'texto_ES' => 'required',
            'fundamentacao_ES' => 'required',
            'comentario_ES' => 'required',
            'email_ES' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'idioma.required' => 'Language required',
            'paise_EN.required' => 'Country (EN) required',
            'autor_EN.required' => 'Author (EN) required',
            'autor_EN.max' => 'Author (EN) max: 500',
            'data_EN.required' => 'Date (EN) required',
            'data_EN.date' => 'Date (EN) invalid',
            'titulo_EN.required' => 'Title (EN) required',
            'titulo_EN.max' => 'Title (EN) max: 500',
            'texto_EN.required' => 'Text (EN) required',
            'fundamentacao_EN.required' => 'Reasoning (EN) required',
            'comentario_EN.required' => 'Comment (EN) required',
            'email_EN.required' => 'E-mail (EN) required',
            'email_EN.max' => 'E-mail (EN) max: 500',
            'paise_DE.required' => 'Country (DE) required',
            'autor_DE.required' => 'Author (DE) required',
            'autor_DE.max' => 'Author (DE) max: 500',
            'data_DE.required' => 'Date (DE) required',
            'data_DE.date' => 'Date (DE) invalid',
            'titulo_DE.required' => 'Title (DE) required',
            'titulo_DE.max' => 'Title (DE) max: 500',
            'texto_DE.required' => 'Text (DE) required',
            'fundamentacao_DE.required' => 'Reasoning (DE) required',
            'comentario_DE.required' => 'Comment (DE) required',
            'email_DE.required' => 'E-mail (DE) required',
            'email_DE.max' => 'E-mail (DE) max: 500',
            'paise_ES.required' => 'Country (ES) required',
            'autor_ES.required' => 'Author (ES) required',
            'autor_ES.max' => 'Author (ES) max: 500',
            'data_ES.required' => 'Date (ES) required',
            'data_ES.date' => 'Date (ES) invalid',
            'titulo_ES.required' => 'Title (ES) required',
            'titulo_ES.max' => 'Title (ES) max: 500',
            'texto_ES.required' => 'Text (ES) required',
            'fundamentacao_ES.required' => 'Reasoning (ES) required',
            'comentario_ES.required' => 'Comment (ES) required',
            'email_ES.required' => 'E-mail (ES) required',
            'email_ES.max' => 'E-mail (ES) max: 500',
        ];
    }
}
