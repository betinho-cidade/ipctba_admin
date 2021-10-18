<?php

namespace App\Exports;

use App\Models\Membro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MembrosExport implements FromCollection, WithMapping, WithHeadings
{

    protected $params;

    public function __construct(Array $params)
    {
        $this->params = $params;
    }


    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Celular',
            'E-mail',
            'Data Nascimento',
            'Naturalidade',
            'Sexo',
            'Cpf',
            'Estado Civil',
            'Cônjuge',
            'Data Casamento',
            'Escolaridade',
            'Profissão',
            'Nome Pai',
            'Nome Mãe',
            'Cep',
            'Cidade',
            'Uf',
            'Logradouro',
            'Número',
            'Bairro',
            'Complemento',
            'URL Imagem',
            'Data Batismo',
            'Pastor Batismo',
            'Igreja Batismo',
            'Data Profisão Fé',
            'Pastor Profisão Fé',
            'Igreja Profisão Fé',
            'Igreja Anterior',
            'Cidade Igreja Anterior',
            'Pastor Igreja Anterior',
            'E-mail Pastor Igreja Anterior',
            'Número ROL',
            'Tipo Membro',
            'Número da Ata',
            'Data Admissão',
            'Meio Admissão',
            'Data Demissão',
            'Meio Demissão',
            'Local Congregação',
            'Status do Membro',
            'Em Disciplina ?',
            'Aptidões',
            'Login',
        ];
    }

    public function map($membro): array
    {

        return [
            $membro->id,
            $membro->nome,
            $membro->celular,
            $membro->email,
            Date::stringToExcel($membro->data_nascimento),
            $membro->naturalidade,
            $membro->descricao_sexo,
            $membro->cpf,
            $membro->descricao_estado_civil,
            $membro->conjuge,
            Date::stringToExcel($membro->data_casamento),
            $membro->descricao_escolaridade,
            $membro->profissao,
            $membro->nome_pai,
            $membro->nome_mae,
            $membro->end_cep,
            $membro->end_cidade,
            $membro->end_uf,
            $membro->end_logradouro,
            $membro->end_numero,
            $membro->end_bairro,
            $membro->end_complemento,
            $membro->path_imagem,
            Date::stringToExcel($membro->data_batismo),
            $membro->pastor_batismo,
            $membro->igreja_batismo,
            Date::stringToExcel($membro->data_profissao_fe),
            $membro->pastor_profissao_fe,
            $membro->igreja_profissao_fe,
            $membro->igreja_old_nome,
            $membro->igreja_old_cidade,
            $membro->igreja_old_pastor,
            $membro->igreja_old_pastor_email,
            $membro->numero_rol,
            $membro->descricao_tipo_membro,
            $membro->numero_ata,
            Date::stringToExcel($membro->data_admissao),
            $membro->meio_admissao->nome ?? '',
            Date::stringToExcel($membro->data_demissao),
            $membro->meio_demissao->nome ?? '',
            $membro->local_congrega->nome ?? '',
            $membro->descricao_status,
            $membro->descricao_is_disciplina,
            $membro->aptidao,
            $membro->user->login ?? '',
        ];

    }

    public function collection()
    {

        $excel_params = $this->params;

        $membros = Membro::where(function($query) use ($excel_params){
            if ($excel_params['is_disciplina']) {
                $query->where('is_disciplina', 'S');
            }
            if ($excel_params['tipo_membro']) {
                $query->where('tipo_membro', $excel_params['tipo_membro']);
            }
            if ($excel_params['sexo']) {
                $query->where('sexo', $excel_params['sexo']);
            }
            if($excel_params['idade_inicial'] && $excel_params['idade_final']){
                $minDate = Carbon::today()->subYears($excel_params['idade_final']);
                $maxDate = Carbon::today()->subYears($excel_params['idade_inicial'])->endOfDay();
                $query->whereBetween('data_nascimento', [$minDate, $maxDate]);
            }
            if($excel_params['dia_niver_ini'] && $excel_params['dia_niver_fim'] && $excel_params['mes_niver_ini'] && $excel_params['mes_niver_fim']){
                $minDate = $excel_params['mes_niver_ini'] . $excel_params['dia_niver_ini'];
                $maxDate = $excel_params['mes_niver_fim'] . $excel_params['dia_niver_fim'];
                $query->whereRaw("DATE_FORMAT(data_nascimento, '%m%d') BETWEEN ? AND ?", [$minDate, $maxDate]);
            }
            if($excel_params['data_admissao_ini'] && $excel_params['data_admissao_fim']){
                $minDate = $excel_params['data_admissao_ini'];
                $maxDate = $excel_params['data_admissao_fim'];
                $query->whereBetween('data_admissao', [$minDate, $maxDate]);
            }
            if($excel_params['data_demissao_ini'] && $excel_params['data_demissao_fim']){
                $minDate = $excel_params['data_demissao_ini'];
                $maxDate = $excel_params['data_demissao_fim'];
                $query->whereBetween('data_demissao', [$minDate, $maxDate]);
            }

        })
        ->orderBy('nome', 'desc')
        ->get();

        return $membros;
    }

}
