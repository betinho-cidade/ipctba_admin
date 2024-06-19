<?php

namespace App\Http\Controllers\Painel\Parametros\SolicitacaoVisitante\ProcessoVisitante;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\SolicitacaoVisitante;
use App\Models\ProcessoVisitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\SolicitacaoVisitante\ProcessoVisitante\CreateRequest;
use App\Http\Requests\Parametros\SolicitacaoVisitante\ProcessoVisitante\UpdateRequest;

class ProcessoVisitanteController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function create(SolicitacaoVisitante $solicitacao_visitante)
    {
        if(Gate::denies('create_processo_visitante')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.solicitacao_visitante.processo_visitante.create', compact('user', 'solicitacao_visitante'));
    }

    public function store(SolicitacaoVisitante $solicitacao_visitante, CreateRequest $request)
    {
        if (Gate::denies('create_processo_visitante')) {
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $processo_visitante = new ProcessoVisitante();

            $processo_visitante->solicitacao_visitante_id = $solicitacao_visitante->id;
            $processo_visitante->nome = $request->nome;

            $processo_visitante->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message != '') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Processo para a Solicitação <code class="highlighter-rouge">' . $request->nome . '</code> foi criado com sucesso');
        }

        return redirect()->route('solicitacao_visitante.show', compact('solicitacao_visitante'));
    }

    public function show(SolicitacaoVisitante $solicitacao_visitante, ProcessoVisitante $processo_visitante)
    {
        if (Gate::denies('view_processo_visitante')) {
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        if ($solicitacao_visitante->id != $processo_visitante->solicitacao_visitante_id) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Informações entre Solicitação e Processo são divergentes');
            return redirect()->route('solicitacao_visitante.index', compact('solicitacao_visitante'));
        }

        return view('painel.parametros.solicitacao_visitante.processo_visitante.show', compact('user', 'solicitacao_visitante', 'processo_visitante'));
    }

    public function update(UpdateRequest $request, SolicitacaoVisitante $solicitacao_visitante, ProcessoVisitante $processo_visitante)
    {
        if (Gate::denies('edit_processo_visitante')) {
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        if ($solicitacao_visitante->id != $processo_visitante->solicitacao_visitante_id) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Informações entre Solicitação e Processo são divergentes');
            return redirect()->route('solicitacao_visitante.index', compact('solicitacao_visitante'));
        }

        $message = '';

        try {

            DB::beginTransaction();

            $processo_visitante->nome = $request->nome;

            $processo_visitante->save();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message != '') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Processo para a Solicitação <code class="highlighter-rouge">' . $request->nome . '</code> foi alterado com sucesso');
        }

        return redirect()->route('solicitacao_visitante.show', compact('solicitacao_visitante'));
    }

    public function destroy(SolicitacaoVisitante $solicitacao_visitante, ProcessoVisitante $processo_visitante, Request $request)
    {
        if (Gate::denies('delete_processo_visitante')) {
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();
        
        if ($solicitacao_visitante->id != $processo_visitante->solicitacao_visitante_id) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Informações entre Solicitação e Processo são divergentes');
            return redirect()->route('solicitacao_visitante.index', compact('solicitacao_visitante'));
        }

        $message = '';
        $processo_visitante_nome = $processo_visitante->nome;

        try {
            DB::beginTransaction();

            $processo_visitante->delete();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();

            if(strpos($ex->getMessage(), 'Integrity constraint violation') !== false){
                $message = "Não foi possível excluir o registro, pois existem referências ao mesmo em outros processos.";
            } else{
                $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ".$ex->getMessage();
            }
        }


        if ($message && $message != '') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Processo da Solicitação <code class="highlighter-rouge">' . $processo_visitante_nome . '</code> foi excluído com sucesso');
        }

        return redirect()->route('solicitacao_visitante.show', compact('solicitacao_visitante'));
    }

      

}
