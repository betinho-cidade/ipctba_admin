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
            'Número ROL',
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
            'Ofício Atual',
            'Ministérios',
            'Situação Atual',
            'Histórico Solicitações',
            'Login',
        ];
    }

    public function map($membro): array
    {

        return [
            $membro->id,
            $membro->numero_rol,
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
            $membro->historico_oficio_atual,
            $membro->ministerios_lista,
            $membro->historico_situacao_atual,
            $membro->historico_solicitacao_lista,
            $membro->user->login ?? '',
        ];

    }

    public function collection()
    {

        $excel_params = $this->params;

        $membros = Membro::where(function($query) use ($excel_params){
            if($excel_params['is_ativo']){
                if ($excel_params['is_ativo'] == 'ativo') {
                    $query->where('status', 'A');
                } elseif ($excel_params['is_ativo'] == 'inativo') {
                    $query->where('status', 'I');
                }
            }
            if ($excel_params['is_disciplina']) {
                $query->where('is_disciplina', 'S');
            }
            if ($excel_params['nome']) {
                $query->where('nome', 'like', '%' . $excel_params['nome'] . '%');
            }
            if ($excel_params['rol']) {
                $query->where('numero_rol', 'like', '%' . $excel_params['rol'] . '%');
            }
            if ($excel_params['tipo_membro']) {
                $query->where('tipo_membro', $excel_params['tipo_membro']);
            } else {
                $query->whereNotIn('tipo_membro', ['EP']);
            }
            if ($excel_params['status_participacao']) {
                $query->where('status_participacao_id', $excel_params['status_participacao']);
            }
            if ($excel_params['estado_civil']) {
                $query->where('estado_civil', $excel_params['estado_civil']);
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
            if($excel_params['dia_casamento_ini'] && $excel_params['dia_casamento_fim'] && $excel_params['mes_casamento_ini'] && $excel_params['mes_casamento_fim']){
                $minDate = $excel_params['mes_casamento_ini'] . $excel_params['dia_casamento_ini'];
                $maxDate = $excel_params['mes_casamento_fim'] . $excel_params['dia_casamento_fim'];
                $query->whereRaw("DATE_FORMAT(data_casamento, '%m%d') BETWEEN ? AND ?", [$minDate, $maxDate]);
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
            if ($excel_params['meio_admissao']) {
                $query->where('meio_admissao_id', $excel_params['meio_admissao']);
            }
            if ($excel_params['meio_demissao']) {
                $query->where('meio_demissao_id', $excel_params['meio_demissao']);
            }
            if($excel_params['oficio']){
                $query->whereIn('membros.id', function($subquery) use ($excel_params) {
                    $subquery->select('membros.id');
                    $subquery->from('historico_oficios');
                    $subquery->join('membros', 'historico_oficios.membro_id', '=','membros.id');
                    $subquery->where("historico_oficios.oficio_id",$excel_params['oficio']);
                    $subquery->whereNull('historico_oficios.data_fim');
                });
            }
            if($excel_params['ministerio']){
                $query->whereIn('membros.id', function($subquery) use ($excel_params) {
                    $subquery->select('membros.id');
                    $subquery->from('membro_ministerios');
                    $subquery->join('membros', 'membro_ministerios.membro_id', '=','membros.id');
                    $subquery->where("membro_ministerios.ministerio_id",$excel_params['ministerio']);
                });
            }
            if($excel_params['situacao']){
                $query->whereIn('membros.id', function($subquery) use ($excel_params) {
                    $subquery->select('membros.id');
                    $subquery->from('historico_situacaos');
                    $subquery->join('membros', 'historico_situacaos.membro_id', '=','membros.id');
                    $subquery->where("historico_situacaos.situacao_membro_id",$excel_params['situacao']);
                    $subquery->whereNull('historico_situacaos.data_fim');
                });
            }
            if($excel_params['tipo_solicitacao']){
                $query->whereIn('membros.id', function($subquery) use ($excel_params) {
                    $subquery->select('membros.id');
                    $subquery->from('historico_solicitacaos');
                    $subquery->join('membros', 'historico_solicitacaos.membro_id', '=','membros.id');
                    $subquery->where("historico_solicitacaos.tipo_solicitacao_id",$excel_params['tipo_solicitacao']);
                });
            }
        })
        ->orderBy($excel_params['order_field'], $excel_params['order_type'])
        ->get();


        return $membros;
    }

}
