<?php

namespace App\Http\Requests\Cadastro\MembroFicha;

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
            'lider' => 'required',
            'membro_sol' => 'required',
            'nome' => 'max:300',
            'email_membro' => 'nullable|email|max:500',
            'celular' => 'max:11',
            'data_nascimento' => 'nullable|date',
            'naturalidade' => 'max:300',
            'conjuge' => 'max:300',
            'data_casamento' => 'nullable|date',
            'profissao' => 'max:300',
            'nome_pai' => 'max:300',
            'nome_mae' => 'max:300',
            'end_cep' => 'max:8',
            'end_cidade' => 'max:60',
            'end_uf' => 'max:2',
            'end_logradouro' => 'max:80',
            'end_numero' => 'max:20',
            'end_bairro' => 'max:60',
            'end_complemento' => 'max:40',
        ];
    }

    public function messages()
    {
        return [

            'lider.required' => 'O Lider que esta solicitando a alteração cadastral é requerido',
            'membro_sol.required' => 'O Membro para a atualização cadastral é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 300 caracteres',
            'email_membro.email' => 'O E-mail do Membro é inválido',
            'email_membro.max' => 'O tamanho permitido para o E-mail d Membro é de 500 caracteres',
            'celular.max' => 'O tamanho permitido para o celular é de 11 dígitos',
            'data_nascimento.date' => 'A data de nascimento é inválida',
            'naturalidade.max' => 'O tamanho permitido para a naturalidade é de 300 caracteres',
            'conjuge.max' => 'O tamanho permitido para o cônjuge é de 300 caracteres',
            'data_casamento.date' => 'A data de casamento é inválida',
            'profissao.max' => 'O tamanho permitido para a profissão é de 300 caracteres',
            'nome_pai.max' => 'O tamanho permitido para o nome do pai é de 300 caracteres',
            'nome_mae.max' => 'O tamanho permitido para o nome da mãe é de 300 caracteres',
            'end_cep.max' => 'O tamanho permitido para o cep é de 8 dígitos',
            'end_cidade.max' => 'O tamanho permitido para a cidade é de 60 caracteres',
            'end_uf.max' => 'O tamanho permitido para a UF é de 2 caracteres',
            'end_logradouro.max' => 'O tamanho permitido para a rua é de 80 caracteres',
            'end_numero.max' => 'O tamanho permitido para o número é de 20 caracteres',
            'end_bairro.max' => 'O tamanho permitido para o bairro é de 60 caracteres',
            'end_complemento.max' => 'O tamanho permitido para o complemento é de 40 caracteres',
        ];
    }
}
