<?php

namespace App\Http\Controllers\Painel\Cadastro\AgendaSolicitacao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\MembroFicha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\AgendaSolicitacao\CreateRequest;
use App\Http\Requests\Cadastro\AgendaSolicitacao\UpdateRequest;
use App\Exports\MembrosExport;
use App\Models\HistoricoSolicitacao;
use App\Models\TipoSolicitacao;
use Image;
use Carbon\Carbon;
use Excel;
use PDF;


class AgendaSolicitacaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_agenda_solicitacao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $agenda_solicitacaos = HistoricoSolicitacao::all();


        return view('painel.cadastro.agenda_solicitacao.index', compact('user', 'agenda_solicitacaos'));
    }


    public function create(Request $request)
    {
        if(Gate::denies('create_agenda_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $tipo_solicitacaos = TipoSolicitacao::all();

        $liders = Membro::orderBy('nome')->get();

        return view('painel.cadastro.agenda_solicitacao.create', compact('user', 'tipo_solicitacaos', 'liders'));
    }


    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_agenda_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();


            $agenda_solicitacao = new HistoricoSolicitacao();

            $agenda_solicitacao->tipo_solicitacao_id = $request->tipo_solicitacao;
            $agenda_solicitacao->user_id = $user->id;
            $agenda_solicitacao->membro_id = $request->membro;
            $agenda_solicitacao->lider_id = ($request->lider) ? $request->lider : null;
            $agenda_solicitacao->data_agendamento = ($request->data_agendamento) ? $request->data_agendamento . ' ' . $request->hora_agendamento : null;
            $agenda_solicitacao->comentario = $request->comentario;
            $agenda_solicitacao->status = 'AB';

            $agenda_solicitacao->save();

            if($agenda_solicitacao->data_agendamento){

                $agenda_solicitacao->status = 'AG';
                $agenda_solicitacao->save();
            }

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Agenda/Solicitação de Cadastro do membro foi criada com sucesso');
        }

        return redirect()->route('agenda_solicitacao.index');
    }


    public function show(HistoricoSolicitacao $agenda_solicitacao, Request $request)
    {

        if(Gate::denies('view_agenda_solicitacao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $liders = Membro::all();

        return view('painel.cadastro.agenda_solicitacao.show', compact('user', 'agenda_solicitacao', 'liders'));
    }


    public function update(UpdateRequest $request, HistoricoSolicitacao $agenda_solicitacao)
    {
        if(Gate::denies('edit_agenda_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        if($agenda_solicitacao->status == 'CL'){
            $message = 'A Agenda / Solicitação já foi concluída. Não pode ser alterada.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('agenda_solicitacao.show', compact('agenda_solicitacao'));
        }

        $message = '';

        try {
            $agenda_solicitacao->user_id = $user->id;
            $agenda_solicitacao->lider_id = $request->lider;
            $agenda_solicitacao->comentario = $request->comentario;
            $agenda_solicitacao->data_agendamento = ($request->data_agendamento) ? $request->data_agendamento . ' ' . $request->hora_agendamento : null;
            $agenda_solicitacao->data_realizacao = ($request->data_realizacao) ? $request->data_realizacao . ' ' . $request->hora_realizacao : null;

            $agenda_solicitacao->save();

            if($agenda_solicitacao->data_realizacao){

                $agenda_solicitacao->status = 'CL';
                $agenda_solicitacao->save();

                if($request->repetir_solicitacao <> 0){

                    $data_agendamento = Carbon::now();
                    $data_agendamento->addDays($request->repetir_solicitacao)->format('Y-m-d H:i:s');

                    $hora_minuto = explode(":", $request->hora_realizacao);

                    $data_agendamento->hour($hora_minuto[0]);
                    $data_agendamento->minute($hora_minuto[1]);

                    $historico_solicitacao_new = new HistoricoSolicitacao();

                    $historico_solicitacao_new->user_id = $user->id;
                    $historico_solicitacao_new->membro_id = $agenda_solicitacao->membro_id;
                    $historico_solicitacao_new->lider_id = $agenda_solicitacao->lider_id;
                    $historico_solicitacao_new->tipo_solicitacao_id = $agenda_solicitacao->tipo_solicitacao_id;
                    $historico_solicitacao_new->data_agendamento = $data_agendamento;
                    $historico_solicitacao_new->comentario = $agenda_solicitacao->comentario;
                    $historico_solicitacao_new->status = 'AG';

                    $historico_solicitacao_new->save();
                }
            } else if($agenda_solicitacao->data_agendamento){

                $agenda_solicitacao->status = 'AG';
                $agenda_solicitacao->save();
            }

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Agenda / Solicitação do membro <code class="highlighter-rouge">'. $agenda_solicitacao->membro->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('agenda_solicitacao.index');
    }


    public function destroy(HistoricoSolicitacao $agenda_solicitacao, Request $request)
    {
        if(Gate::denies('delete_agenda_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        if($agenda_solicitacao->status == 'CL'){
            $message = 'A Agenda / Solicitação já foi concluída. Não pode ser excluída.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('agenda_solicitacao.index');
        }

        $message = '';

        try {
            DB::beginTransaction();

            $agenda_solicitacao->delete();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            if(strpos($ex->getMessage(), 'Integrity constraint violation') !== false){
                $message = "Não foi possível excluir o registro, pois existem referências ao mesmo em outros processos.";
            } else{
                $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ".$ex->getMessage();
            }

        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Agenda / Solicitação do membro foi excluída com sucesso');
        }

        return redirect()->route('agenda_solicitacao.index');
    }

}
