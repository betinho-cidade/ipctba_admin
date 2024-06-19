<?php

namespace App\Http\Requests\Guest\FichaVisitante;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'celular' => Str::of($this->celular)->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'end_cep' => Str::of($this->end_cep)->replaceMatches('/[^z0-9]++/', '')->__toString(),
        ]);
    }


    public function rules()
    {

        return [
            'nome' => 'required|max:300',
            'email_membro' => 'nullable|email|max:500',
            'celular' => 'required|max:11',
            'data_nascimento' => 'nullable|date',
            'end_cep' => 'max:8',
            'end_cidade' => 'max:60',
            'end_uf' => 'max:2',
            'end_logradouro' => 'max:80',
            'end_numero' => 'max:20',
            'end_bairro' => 'max:60',
            'end_complemento' => 'max:40',
            'igreja_frequenta' => 'max:300',
            'igreja_cidade' => 'max:150',
        ];
    }

    public function messages()
    {
        return [

            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 300 caracteres',
            'email_membro.email' => 'O E-mail do Membro é inválido',
            'email_membro.max' => 'O tamanho permitido para o E-mail d Membro é de 500 caracteres',
            'celular.required' => 'O celular é requerido',
            'celular.max' => 'O tamanho permitido para o celular é de 11 dígitos',
            'data_nascimento.date' => 'A data de nascimento é inválida',
            'end_cep.max' => 'O tamanho permitido para o cep é de 8 dígitos',
            'end_cidade.max' => 'O tamanho permitido para a cidade é de 60 caracteres',
            'end_uf.max' => 'O tamanho permitido para a UF é de 2 caracteres',
            'end_logradouro.max' => 'O tamanho permitido para a rua é de 80 caracteres',
            'end_numero.max' => 'O tamanho permitido para o número é de 20 caracteres',
            'end_bairro.max' => 'O tamanho permitido para o bairro é de 60 caracteres',
            'end_complemento.max' => 'O tamanho permitido para o complemento é de 40 caracteres',
            'igreja_frequenta.max' => 'O tamanho permitido para a igreja que frequenta é de 300 caracteres',
            'igreja_cidade.max' => 'O tamanho permitido para a cidade/uf da igreja é de 150 caracteres',
        ];
    }
}
