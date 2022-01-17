<?php

namespace App\Http\Controllers\Painel\Dashboard\Indicador;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
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



class IndicadorController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_indicador')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $grahp_total = [
            'ativo' => 0,
            'tipo' => 0,
            'participacao' => 0,
        ];

        //Membros Ativos
        //-----------------------------------------------------------------------
        $membro_ativos = Membro::select("status", DB::raw("count(*) as qtde"))
                                    ->groupBy('status')
                                    ->get();
        $count = 0;
        $graph_ativos = [];
        if($membro_ativos){
            $tot_ativos = 0;
            foreach($membro_ativos as $membro_ativo){
                $graph_ativos[$count] = [
                    'status' => $membro_ativo->descricao_status,
                    'qtde' => $membro_ativo->qtde
                ];
                $tot_ativos = $tot_ativos + $membro_ativo->qtde;
                $count = $count + 1;
            }
        }
        $graph_total['ativo'] = $tot_ativos;


        //Tipo de Membros
        //-----------------------------------------------------------------------
        $membro_tipos = Membro::select("tipo_membro", DB::raw("count(*) as qtde"))
                                    ->groupBy('tipo_membro')
                                    ->whereNotIn('tipo_membro', ['PS', 'NM'])
                                    ->where('status', 'A')
                                    ->get();

        $count = 0;
        $graph_tipos = [];
        if($membro_tipos){
            $tot_tipos = 0;
            foreach($membro_tipos as $membro_tipo){
                $graph_tipos[$count] = [
                    'tipo' => $membro_tipo->descricao_tipo_membro,
                    'qtde' => $membro_tipo->qtde
                ];
                $tot_tipos = $tot_tipos + $membro_tipo->qtde;
                $count = $count + 1;
            }
        }
        $graph_total['tipo'] = $tot_tipos;

        //Status de Participação
        //-----------------------------------------------------------------------
        $membro_partcipacaos = Membro::select("status_participacao_id", DB::raw("count(*) as qtde"))
                                            ->groupBy('status_participacao_id')
                                            ->where('status', 'A')
                                            ->get();

        $count = 0;
        $graph_participacaos = [];
        if($membro_partcipacaos){
            $tot_participacaos = 0;
            foreach($membro_partcipacaos as $membro_partcipacao){
                $graph_participacaos[$count] = [
                    'participacao' => $membro_partcipacao->status_participacao->nome,
                    'qtde' => $membro_partcipacao->qtde
                ];
                $tot_participacaos = $tot_participacaos + $membro_partcipacao->qtde;
                $count = $count + 1;
            }
        }
        $graph_total['participacao'] = $tot_participacaos;

        //Aniversariantes da Semana
        //-----------------------------------------------------------------------
        $now = Carbon::now();
        $inicio_semana = $now->copy()->startOfWeek()->format('md');
        $fim_semana = $now->copy()->endOfWeek()->format('md');

        $periodo = $now->copy()->startOfWeek()->format('d/m') . ' à ' . $now->copy()->endOfWeek()->format('d/m');

        $aniversariantes = Membro::whereRaw("DATE_FORMAT(data_nascimento, '%m%d') BETWEEN ? AND ?", [$inicio_semana, $fim_semana])
                                    ->where('status', 'A')
                                    ->orderByRaw('DATE_FORMAT(data_nascimento, "%m%d")')
                                    ->get();


        return view('painel.dashboard.indicador.index', compact('user', 'graph_ativos', 'graph_tipos', 'graph_participacaos', 'graph_total', 'aniversariantes', 'periodo'));
    }


}

