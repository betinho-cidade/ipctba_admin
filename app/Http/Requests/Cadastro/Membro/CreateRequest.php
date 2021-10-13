<?php

namespace App\Http\Requests\Cadastro\Membro;

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
            'cpf' => Str::of($this->cpf)->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'celular' => Str::of($this->celular)->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'end_cep' => Str::of($this->end_cep)->replaceMatches('/[^z0-9]++/', '')->__toString(),
        ]);
    }


    public function rules()
    {

        return [
            'nome' => 'required|max:300',
            'email_membro' => 'nullable|email|max:500',
            'cpf' => 'nullable|max:11|unique:membros,cpf',
            'sexo' => 'required',
            'celular' => 'required|max:11',
            'data_nascimento' => 'required|date',
            'naturalidade' => 'required|max:300',
            'situacao_membro' => 'required',
            'conjuge' => 'max:300',
            'data_casamento' => 'nullable|date',
            'profissao' => 'max:300',
            'nome_pai' => 'max:300',
            'nome_mae' => 'required|max:300',
            "filho_nome"    => "array",
            "filho_nome.*"  => "max:300",
            "filho_data_nascimento"  => "array",
            "filho_data_nascimento.*"  => "nullable|required_with:filho_nome|date",
            "filho_sexo"  => "array",
            "filho_sexo.*"  => "required_with:filho_nome",
            'end_cep' => 'max:8',
            'end_cidade' => 'max:60',
            'end_uf' => 'max:2',
            'end_logradouro' => 'max:80',
            'end_numero' => 'max:20',
            'end_bairro' => 'max:60',
            'end_complemento' => '|max:40',
            'numero_rol' => 'nullable|max:50|unique:membros,numero_rol',
            'tipo_membro' => 'required',
            'data_batismo' => 'nullable|date',
            'pastor_batismo' => 'max:300',
            'igreja_batismo' => 'max:300',
            'data_profissao_fe' => 'nullable|date',
            'pastor_profissao_fe' => 'max:300',
            'igreja_profissao_fe' => 'max:300',
            'igreja_old_nome' => 'max:300',
            'igreja_old_cidade' => 'max:200',
            'igreja_old_pastor' => 'max:300',
            'igreja_old_pastor_email' => 'max:300',
            'numero_ata' => 'max:50',
            'data_admissao' => 'nullable|date',
            'data_demissao' => 'nullable|date',
            'path_imagem' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'email' => 'max:300|unique:users,email', //Login de Acesso
            'password' => 'nullable|min:8',
            'password_confirm' => 'same:password',
        ];
    }

    public function messages()
    {
        return [

            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 300 caracteres',
            'email_membro.email' => 'O E-mail do Membro é inválido',
            'email_membro.max' => 'O tamanho permitido para o E-mail d Membro é de 500 caracteres',
            'cpf.max' => 'O tamanho permitido para o CPF d Membro é de 11 dígitos',
            'cpf.unique' => 'O CPF informado já existe',
            'sexo.required' => 'O sexo é requerido',
            'celular.required' => 'O celular é requerido',
            'celular.max' => 'O tamanho permitido para o celular é de 11 dígitos',
            'data_nascimento.required' => 'A data de nascimento é requerida',
            'data_nascimento.date' => 'A data de nascimento é inválida',
            'naturalidade.required' => 'A naturalidade é requerida',
            'naturalidade.max' => 'O tamanho permitido para a naturalidade é de 300 caracteres',
            'situacao_membro.required' => 'A situação do membro é requerido',
            'conjuge.max' => 'O tamanho permitido para o cônjuge é de 300 caracteres',
            'data_casamento.date' => 'A data de casamento é inválida',
            'profissao.max' => 'O tamanho permitido para a profissão é de 300 caracteres',
            'nome_pai.max' => 'O tamanho permitido para o nome do pai é de 300 caracteres',
            'nome_mae.required' => 'O nome da mãe é requerido',
            'nome_mae.max' => 'O tamanho permitido para o nome da mãe é de 300 caracteres',
            'filho_nome.*.max' => 'O tamanho permitido para o nome do filho é de 300 caracteres.',
            'filho_data_nascimento.*.date' => 'A data de nascimento do filho é inválida',
            'filho_data_nascimento.*.required_with' => 'Necessário preencher todas as três informações do filho (nome, data de nascimento e sexo)',
            'filho_sexo.*.required_with' => 'Necessário preencher todas as três informações do filho (nome, data de nascimento e sexo)',
            'end_cep.max' => 'O tamanho permitido para o cep é de 8 dígitos',
            'end_cidade.max' => 'O tamanho permitido para a cidade é de 60 caracteres',
            'end_uf.max' => 'O tamanho permitido para a UF é de 2 caracteres',
            'end_logradouro.max' => 'O tamanho permitido para a rua é de 80 caracteres',
            'end_numero.max' => 'O tamanho permitido para o número é de 20 caracteres',
            'end_bairro.max' => 'O tamanho permitido para o bairro é de 60 caracteres',
            'end_complemento.max' => 'O tamanho permitido para o complemento é de 40 caracteres',
            'numero_rol.max' => 'O tamanho permitido para o número do ROL é de 50 caracteres',
            'numero_rol.unique' => 'O número do ROL informado já existe',
            'tipo_membro.required' => 'O tipo de membro requerido',
            'data_batismo.date' => 'A data de batismo é inválida',
            'pastor_batismo.max' => 'O tamanho permitido para o Pastor de Batismo é de 300 caracteres',
            'igreja_batismo.max' => 'O tamanho permitido para a Igreja de Batismo é de 300 caracteres',
            'data_profissao_fe.date' => 'A data de profissão de fé é inválida',
            'pastor_profissao_fe.max' => 'O tamanho permitido para o pastor da profissão de fé é de 300 caracteres',
            'igreja_profissao_fe.max' => 'O tamanho permitido para a Igreja da profissão de fé é de 300 caracteres',
            'igreja_old_nome.max' => 'O tamanho permitido para o Nome da Igreja Anterior é de 300 caracteres',
            'igreja_old_cidade.max' => 'O tamanho permitido para a Cidade/Estado da Igreja Anterior é de 200 caracteres',
            'igreja_old_pastor.max' => 'O tamanho permitido para o Nome do Pastor da Igreja Anterior é de 300 caracteres',
            'igreja_old_pastor_email.max' => 'O tamanho permitido para o E-mail do Pastor da Igreja Anterior é de 300 caracteres',
            'numero_ata.max' => 'O tamanho permitido para o Número da Ata é de 50 caracteres',
            'data_admissao.date' => 'A data de admissão é inválida',
            'data_demissao.date' => 'A data de demissão é inválida',
            'path_imagem.image' => 'Somente arquivo do tipo imagens pode ser anexada para a Imagem do Membro',
            'path_imagem.mimes' => 'Somente imagens do tipo JPEG|JPG|PNG|GIF|SVG são permitidas para a Imagem do Membro',
            'path_imagem.max' => 'O tamanho máximo permitido para a Imagem do Membro é de 1Mb.',
            'email.max' => 'O tamanho permitido para o Login de Acesso é de 300 caracteres',
            'email.unique' => 'O Login de Acesso informado já existe',
            'password.min' => 'O tamanho MÍNIMO permitido para a senha é de 8 caracteres',
            'password_confirm.same' => 'A Senha de Confirmação deve ser igual a Senha',
        ];
    }
}
