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



class AgendaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_agenda')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $historico_solicitacaos = HistoricoSolicitacao::whereNull('data_realizacao')
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

        return view('painel.dashboard.agenda.index', compact('user', 'agendas'));
    }


}

