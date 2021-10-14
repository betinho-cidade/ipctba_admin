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

        //Membros Ativos
        //-----------------------------------------------------------------------        
        $membro_ativos = Membro::select("status", DB::raw("count(*) as qtde"))
                                    ->groupBy('status')
                                    ->get();
        $count = 0;
        $graph_ativos = [];
        if($membro_ativos){
            foreach($membro_ativos as $membro_ativo){
                $graph_ativos[$count] = [
                    'status' => $membro_ativo->descricao_status,
                    'qtde' => $membro_ativo->qtde
                ];
                $count = $count + 1;
            }
        }

        //Tipo de Membros
        //-----------------------------------------------------------------------
        $membro_tipos = Membro::select("tipo_membro", DB::raw("count(*) as qtde"))
                                    ->groupBy('tipo_membro')
                                    ->get();
        $count = 0;
        $graph_tipos = [];
        if($membro_tipos){
            foreach($membro_tipos as $membro_tipo){
                $graph_tipos[$count] = [
                    'tipo' => $membro_tipo->descricao_tipo_membro,
                    'qtde' => $membro_tipo->qtde
                ];
                $count = $count + 1;
            }
        }   

        //Status de Participação        
        //-----------------------------------------------------------------------
        $membro_patcipacaos = Membro::select("status_participacao_id", DB::raw("count(*) as qtde"))
                                            ->groupBy('status_participacao_id')
                                            ->get();        
        $count = 0;
        $graph_participacaos = [];
        if($membro_patcipacaos){
            foreach($membro_patcipacaos as $membro_patcipacao){
                $graph_participacaos[$count] = [
                    'participacao' => $membro_patcipacao->status_participacao->nome,
                    'qtde' => $membro_patcipacao->qtde
                ];
                $count = $count + 1;
            }
        }   

        //Aniversariantes da Semana
        //-----------------------------------------------------------------------        
        $now = Carbon::now();
        $inicio_semana = $now->copy()->startOfWeek()->format('md');
        $fim_semana = $now->copy()->endOfWeek()->format('md');

        $periodo = $now->copy()->startOfWeek()->format('d/m') . ' à ' . $now->copy()->endOfWeek()->format('d/m');

        $aniversariantes = Membro::whereRaw("DATE_FORMAT(data_nascimento, '%m%d') BETWEEN ? AND ?", [$inicio_semana, $fim_semana])->get();                                       
                           
                                       
        return view('painel.dashboard.indicador.index', compact('user', 'graph_ativos', 'graph_tipos', 'graph_participacaos', 'aniversariantes', 'periodo'));
    }


}

