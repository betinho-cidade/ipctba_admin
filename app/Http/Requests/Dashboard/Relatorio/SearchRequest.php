<?php

namespace App\Http\Requests\Dashboard\Relatorio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class SearchRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idade_inicial' => 'nullable|required_with:idade_final|integer',
            'idade_final' => 'nullable|required_with:idade_inicial|integer',
            'data_admissao_ini' => 'nullable|required_with:data_admissao_fim|date',
            'data_admissao_fim' => 'nullable|required_with:data_admissao_ini|date',
            'data_demissao_ini' => 'nullable|required_with:data_demissao_fim|date',
            'data_demissao_fim' => 'nullable|required_with:data_demissao_ini|date',
            'dia_niver_ini' => 'nullable|required_with:dia_niver_fim|required_with:mes_niver_ini|required_with:mes_niver_fim',
            'dia_niver_fim' => 'nullable|required_with:dia_niver_ini|required_with:mes_niver_ini|required_with:mes_niver_fim',
            'mes_niver_ini' => 'nullable|required_with:dia_niver_ini|required_with:dia_niver_fim|required_with:mes_niver_fim',
            'mes_niver_fim' => 'nullable|required_with:dia_niver_ini|required_with:dia_niver_fim|required_with:mes_niver_ini',
        ];
    }

    public function messages()
    {
        return [
            'idade_inicial.integer' => 'Idade Inicial somente aceita dígitos',
            'idade_inicial.required_with' => 'Idade Inicial requerida com Idade Final',
            'idade_final.integer' => 'Idade Inicial somente aceita dígitos',
            'idade_final.required_with' => 'Idade Final requerida com Idade Inicial',
            'data_admissao_ini.date' => 'A data de admissão inicial é inválida',
            'data_admissao_ini.required_with' => 'A data de admissão deve ter os intervalos Inicial e Final informados',
            'data_admissao_fim.date' => 'A data de admissão final é inválida',
            'data_admissao_fim.required_with' => 'A data de admissão deve ter os intervalos Inicial e Final informados',
            'data_demissao_ini.date' => 'A data de demissão inicial é inválida',
            'data_demissao_ini.required_with' => 'A data de demissão deve ter os intervalos Inicial e Final informados',
            'data_demissao_fim.date' => 'A data de demissão final é inválida',
            'data_demissao_fim.required_with' => 'A data de demissão deve ter os intervalos Inicial e Final informados',
            'dia_niver_ini.required_with' => 'O Dia/Mês Aniversário precisa estar cmo todos os campos preenchidos',
            'dia_niver_fim.required_with' => 'O Dia/Mês Aniversário precisa estar cmo todos os campos preenchidos',
            'mes_niver_ini.required_with' => 'O Dia/Mês Aniversário precisa estar cmo todos os campos preenchidos',
            'mes_niver_fim.required_with' => 'O Dia/Mês Aniversário precisa estar cmo todos os campos preenchidos',

        ];
    }
}
