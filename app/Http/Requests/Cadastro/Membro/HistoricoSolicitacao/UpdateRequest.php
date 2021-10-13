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
            'data_agendamento' => 'required|date',
            'hora_agendamento' => 'required',
            'data_realizacao' => 'nullable|required_with:repetir_solicitacao,hora_realizacao|date', 
            'hora_realizacao' => 'required_with:data_realizacao',
            'repetir_solicitacao' => 'required_with:data_realizacao',
        ];
    }

    public function messages()
    {
        return [
            'lider.required' => 'O Líder é requerido',
            'data_agendamento.required' => 'A Data do Agendamento é requerida',
            'data_agendamento.date' => 'A Data do Agendamento é inválida',
            'hora_agendamento.required' => 'A Hora do Agendamento é requerida',
            'data_realizacao.date' => 'A Data Realização é inválida', 
            'data_realizacao.required_with' => 'A Data de Realização é requerida em conjunto com a Hora de Realização e a Repetição ou não da Solicitação', 
            'hora_realizacao.required_with' => 'O campo Hora de Realização deve ser preenchido se a Data de Realização for preenchida',
            'repetir_solicitacao.required_with' => 'O campo Repetir Soliticação deve ser preenchido se a Data de Realização for preenchida',
        ];
    }

}
