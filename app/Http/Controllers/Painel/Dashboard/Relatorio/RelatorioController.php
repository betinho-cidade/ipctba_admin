<?php

namespace App\Http\Controllers\Painel\Dashboard\Relatorio;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\StatusParticipacao;
use App\Models\MeioAdmissao;
use App\Models\MeioDemissao;
use App\Models\Oficio;
use App\Models\Ministerio;
use App\Models\SituacaoMembro;
use App\Models\TipoSolicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\Relatorio\SearchRequest;
use App\Exports\MembrosExport;
use Image;
use Carbon\Carbon;
use Excel;



class RelatorioController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_relatorio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $membros = null;

        $status_participacaos = StatusParticipacao::orderBy('nome')->get();

        $meio_admissaos = MeioAdmissao::orderBy('nome')->get();

        $meio_demissaos = MeioDemissao::orderBy('nome')->get();

        $oficios = Oficio::orderBy('nome')->get();

        $ministerios = Ministerio::orderBy('nome')->get();

        $situacaos = SituacaoMembro::orderBy('nome')->get();

        $tipo_solicitacaos = TipoSolicitacao::orderBy('nome')->get();

        $excel_params = [];

        return view('painel.dashboard.relatorio.index', compact('user', 'membros', 'status_participacaos', 'meio_admissaos', 'meio_demissaos', 'oficios', 'ministerios', 'situacaos', 'tipo_solicitacaos', 'excel_params'));
    }




    public function search(SearchRequest $request)
    {
        if(Gate::denies('view_relatorio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        if($request->excel_params) {
            $excel_params = [
                'is_disciplina' => isset($request->excel_params['is_disciplina']) ? $request->excel_params['is_disciplina'] : '',
                'is_ativo' => isset($request->excel_params['is_ativo']) ? $request->excel_params['is_ativo'] : '',
                'order_field' => isset($request->excel_params['order_field']) ? $request->excel_params['order_field'] : 'nome',
                'order_type' => isset($request->excel_params['order_type']) ? $request->excel_params['order_type'] : 'asc',
                'nome' => isset($request->excel_params['nome']) ? $request->excel_params['nome'] : '',
                'rol' => isset($request->excel_params['rol']) ? $request->excel_params['rol'] : '',
                'tipo_membro' => isset($request->excel_params['tipo_membro']) ? $request->excel_params['tipo_membro'] : '',
                'status_participacao' => isset($request->excel_params['status_participacao']) ? $request->excel_params['status_participacao'] : '',
                'estado_civil' => isset($request->excel_params['estado_civil']) ? $request->excel_params['estado_civil'] : '',
                'sexo' => isset($request->excel_params['sexo']) ? $request->excel_params['sexo'] : '',
                'idade_inicial' => isset($request->excel_params['idade_inicial']) ? $request->excel_params['idade_inicial'] : '',
                'idade_final' => isset($request->excel_params['idade_final']) ? $request->excel_params['idade_final'] : '',
                'dia_niver_ini' => isset($request->excel_params['dia_niver_ini']) ? $request->excel_params['dia_niver_ini'] : '',
                'dia_niver_fim' => isset($request->excel_params['dia_niver_fim']) ? $request->excel_params['dia_niver_fim'] : '',
                'mes_niver_ini' => isset($request->excel_params['mes_niver_ini']) ? $request->excel_params['mes_niver_ini'] : '',
                'mes_niver_fim' => isset($request->excel_params['mes_niver_fim']) ? $request->excel_params['mes_niver_fim'] : '',
                'dia_casamento_ini' => isset($request->excel_params['dia_casamento_ini']) ? $request->excel_params['dia_casamento_ini'] : '',
                'dia_casamento_fim' => isset($request->excel_params['dia_casamento_fim']) ? $request->excel_params['dia_casamento_fim'] : '',
                'mes_casamento_ini' => isset($request->excel_params['mes_casamento_ini']) ? $request->excel_params['mes_casamento_ini'] : '',
                'mes_casamento_fim' => isset($request->excel_params['mes_casamento_fim']) ? $request->excel_params['mes_casamento_fim'] : '',
                'data_admissao_ini' => isset($request->excel_params['data_admissao_ini']) ? $request->excel_params['data_admissao_ini'] : '',
                'data_admissao_fim' => isset($request->excel_params['data_admissao_fim']) ? $request->excel_params['data_admissao_fim'] : '',
                'data_demissao_ini' => isset($request->excel_params['data_demissao_ini']) ? $request->excel_params['data_demissao_ini'] : '',
                'data_demissao_fim' => isset($request->excel_params['data_demissao_fim']) ? $request->excel_params['data_demissao_fim'] : '',
                'meio_admissao' => isset($request->excel_params['meio_admissao']) ? $request->excel_params['meio_admissao'] : '',
                'meio_demissao' => isset($request->excel_params['meio_demissao']) ? $request->excel_params['meio_demissao'] : '',
                'oficio' => isset($request->excel_params['oficio']) ? $request->excel_params['oficio'] : '',
                'ministerio' => isset($request->excel_params['ministerio']) ? $request->excel_params['ministerio'] : '',
                'situacao' => isset($request->excel_params['situacao']) ? $request->excel_params['situacao'] : '',
                'tipo_solicitacao' => isset($request->excel_params['tipo_solicitacao']) ? $request->excel_params['tipo_solicitacao'] : '',
            ];
        } else {
            $excel_params = [
                'is_disciplina' => isset($request->is_disciplina) ? $request->is_disciplina : '',
                'is_ativo' => isset($request->is_ativo) ? $request->is_ativo : '',
                'order_field' => isset($request->order_field) ? $request->order_field : 'nome',
                'order_type' => isset($request->order_type) ? $request->order_type : 'asc',
                'nome' => isset($request->nome) ? $request->nome : '',
                'rol' => isset($request->rol) ? $request->rol : '',
                'tipo_membro' => isset($request->tipo_membro) ? $request->tipo_membro : '',
                'status_participacao' => isset($request->status_participacao) ? $request->status_participacao : '',
                'estado_civil' => isset($request->estado_civil) ? $request->estado_civil : '',
                'sexo' => isset($request->sexo) ? $request->sexo : '',
                'idade_inicial' => isset($request->idade_inicial) ? $request->idade_inicial : '',
                'idade_final' => isset($request->idade_final) ? $request->idade_final : '',
                'dia_niver_ini' => isset($request->dia_niver_ini) ? $request->dia_niver_ini : '',
                'dia_niver_fim' => isset($request->dia_niver_fim) ? $request->dia_niver_fim : '',
                'mes_niver_ini' => isset($request->mes_niver_ini) ? $request->mes_niver_ini : '',
                'mes_niver_fim' => isset($request->mes_niver_fim) ? $request->mes_niver_fim : '',
                'dia_casamento_ini' => isset($request->dia_casamento_ini) ? $request->dia_casamento_ini : '',
                'dia_casamento_fim' => isset($request->dia_casamento_fim) ? $request->dia_casamento_fim : '',
                'mes_casamento_ini' => isset($request->mes_casamento_ini) ? $request->mes_casamento_ini : '',
                'mes_casamento_fim' => isset($request->mes_casamento_fim) ? $request->mes_casamento_fim : '',
                'data_admissao_ini' => isset($request->data_admissao_ini) ? $request->data_admissao_ini : '',
                'data_admissao_fim' => isset($request->data_admissao_fim) ? $request->data_admissao_fim : '',
                'data_demissao_ini' => isset($request->data_demissao_ini) ? $request->data_demissao_ini : '',
                'data_demissao_fim' => isset($request->data_demissao_fim) ? $request->data_demissao_fim : '',
                'meio_admissao' => isset($request->meio_admissao) ? $request->meio_admissao : '',
                'meio_demissao' => isset($request->meio_demissao) ? $request->meio_demissao : '',
                'oficio' => isset($request->oficio) ? $request->oficio : '',
                'ministerio' => isset($request->ministerio) ? $request->ministerio : '',
                'situacao' => isset($request->situacao) ? $request->situacao : '',
                'tipo_solicitacao' => isset($request->tipo_solicitacao) ? $request->tipo_solicitacao : '',
            ];
        }

        $excel_params_translate = [
            'is_disciplina' => 'Em Disciplina',
            'is_ativo' => 'Situação Membro',
            'order_field' => 'Ordenação por',
            'order_type' => 'Forma Ordenação',
            'nome' => 'Nome',
            'rol' => 'Número ROL',
            'tipo_membro' => 'Tipo Membro',
            'status_participacao' => 'Status de Participação',
            'estado_civil' => 'Estado Civil',
            'sexo' => 'Sexo',
            'idade_inicial' => 'Idade Inicial',
            'idade_final' => 'Idade Final',
            'dia_niver_ini' => 'Dia Aniversário Inicial',
            'dia_niver_fim' => 'Dia Aniversário Final',
            'mes_niver_ini' => 'Mês Aniversário Inicial',
            'mes_niver_fim' => 'Mês Aniversário Final',
            'dia_casamento_ini' => 'Dia Casamento Inicial',
            'dia_casamento_fim' => 'Dia Casamento Final',
            'mes_casamento_ini' => 'Mês Casamento Inicial',
            'mes_casamento_fim' => 'Mês Casamento Final',
            'data_admissao_ini' => 'Data Admissão Inicial',
            'data_admissao_fim' => 'Data Admissão Final',
            'data_demissao_ini' => 'Data Demissão Inicial',
            'data_demissao_fim' => 'Data Demissão Final',
            'meio_admissao' => 'Meio de Admissão',
            'meio_demissao' => 'Meio de Demissão',
            'oficio' => 'Ofício',
            'ministerio' => 'Ministério',
            'situacao' => 'Situação',
            'tipo_solicitacao' => 'Tipo de Solicitação',
        ];

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
                    ->paginate(300);

        $status_participacaos = StatusParticipacao::orderBy('nome')->get();

        $meio_admissaos = MeioAdmissao::orderBy('nome')->get();

        $meio_demissaos = MeioDemissao::orderBy('nome')->get();

        $oficios = Oficio::orderBy('nome')->get();

        $ministerios = Ministerio::orderBy('nome')->get();

        $situacaos = SituacaoMembro::orderBy('nome')->get();

        $tipo_solicitacaos = TipoSolicitacao::orderBy('nome')->get();

        $status_descricao = ($excel_params['status_participacao']) ? StatusParticipacao::where('id', $excel_params['status_participacao'])->first() : '';

        $oficio_descricao = ($excel_params['oficio']) ? Oficio::where('id', $excel_params['oficio'])->first() : '';

        $ministerio_descricao = ($excel_params['ministerio']) ? Ministerio::where('id', $excel_params['ministerio'])->first() : '';

        $situacao_descricao = ($excel_params['situacao']) ? SituacaoMembro::where('id', $excel_params['situacao'])->first() : '';

        $tipo_solicitacao_descricao = ($excel_params['tipo_solicitacao']) ? TipoSolicitacao::where('id', $excel_params['tipo_solicitacao'])->first() : '';

        return view('painel.dashboard.relatorio.index', compact('user', 'membros', 'excel_params', 'excel_params_translate', 'status_participacaos', 'meio_admissaos', 'meio_demissaos','oficios', 'ministerios', 'situacaos', 'tipo_solicitacaos', 'status_descricao', 'oficio_descricao', 'ministerio_descricao', 'situacao_descricao', 'tipo_solicitacao_descricao'));
    }

    public function excell(Request $request)
    {
        if(Gate::denies('view_relatorio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return Excel::download(new MembrosExport($request->excel_params), 'membros.xlsx');
    }


}

