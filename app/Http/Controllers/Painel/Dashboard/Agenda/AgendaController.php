<?php

namespace App\Http\Controllers\Painel\Dashboard\Agenda;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\HistoricoSolicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon\Carbon;



class AgendaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if(Gate::denies('view_agenda')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $lista_meses = HistoricoSolicitacao::where('status', 'AG')
                                             ->orderBy('data_agendamento')
                                             ->get()
                                             ->transform(function($item) {
                                                return Carbon::parse($item->data_agendamento)->format('Y-m');
                                             })
                                              ->unique(function($item) {
                                                return $item;
                                              });
        $agenda_meses = [];
        foreach($lista_meses as $agenda_mes){
            $agenda_meses[$agenda_mes] = ucfirst(strftime('%b/%y', strtotime($agenda_mes)));
        }


        $mes_atual = date('Y-m', strtotime(Carbon::now()));
        $referencia = ($request->anomes && strrpos($request->anomes, '-')) ? explode("-", $request->anomes) : explode("-", $mes_atual);

        $historico_solicitacaos = HistoricoSolicitacao::where('status', 'AG')
                                                        ->where(function($query) use ($referencia){
                                                            if ($referencia) {
                                                                $query->whereYear('data_agendamento', '=', $referencia[0])
                                                                      ->whereMonth('data_agendamento', '=', $referencia[1]);
                                                            }
                                                        })
                                                        ->orderBy('data_agendamento')
                                                        ->get();

        $ano_mes = '190001';
        $count = 0;
        $agendas = null;

        foreach($historico_solicitacaos as $solicitacao){
            $ano_mes_proximo = $solicitacao->data_agendamento_ano_mes_formatada;

            if($ano_mes != $ano_mes_proximo){
                $ano_mes = $ano_mes_proximo;
                $count = 0;
            }

            $agendas[$ano_mes][$count] = [
                'membro' => $solicitacao->membro->nome,
                'lider' => strtok($solicitacao->lider->nome, " "),
                'tipo_solicitacao' => $solicitacao->tipo_solicitacao->nome,
                'comentario' => $solicitacao->comentario,
                'data' => $solicitacao->data_agendamento_agenda,
                'historico_solicitacao_obj' => $solicitacao,
            ];

            $count = $count + 1;
        }

        return view('painel.dashboard.agenda.index', compact('user', 'agendas', 'agenda_meses'));
    }

}

