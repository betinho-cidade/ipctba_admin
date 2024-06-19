<?php

namespace App\Http\Controllers\Painel\Parametros\SolicitacaoVisitante;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\SolicitacaoVisitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\SolicitacaoVisitante\CreateRequest;
use App\Http\Requests\Parametros\SolicitacaoVisitante\UpdateRequest;

class SolicitacaoVisitanteController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_processo_visitante')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $solicitacao_visitantes = SolicitacaoVisitante::all();

        return view('painel.parametros.solicitacao_visitante.index', compact('user', 'solicitacao_visitantes'));
    }



    public function create()
    {
        if(Gate::denies('create_processo_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.solicitacao_visitante.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_processo_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $solicitacao_visitante = new SolicitacaoVisitante();

            $solicitacao_visitante->nome = $request->nome;
            $solicitacao_visitante->origem = $request->origem;
            $solicitacao_visitante->informar_motivo = $request->informar_motivo;

            $solicitacao_visitante->save();

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
            $request->session()->flash('message.content', 'A Solicitação <code class="highlighter-rouge">'. $solicitacao_visitante->nome .'</code> foi criada com sucesso');
        }

        return redirect()->route('solicitacao_visitante.index');
    }



    public function show(SolicitacaoVisitante $solicitacao_visitante)
    {

        if(Gate::denies('edit_processo_visitante')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.solicitacao_visitante.show', compact('user', 'solicitacao_visitante'));
    }



    public function update(UpdateRequest $request, SolicitacaoVisitante $solicitacao_visitante)
    {
        if(Gate::denies('edit_processo_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $solicitacao_visitante->nome = $request->nome;
            $solicitacao_visitante->origem = $request->origem;
            $solicitacao_visitante->informar_motivo = $request->informar_motivo;

            $solicitacao_visitante->save();

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
            $request->session()->flash('message.content', 'A Solicitação <code class="highlighter-rouge">'. $solicitacao_visitante->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('solicitacao_visitante.index');
    }



    public function destroy(SolicitacaoVisitante $solicitacao_visitante, Request $request)
    {
        if(Gate::denies('delete_processo_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $solicitacao_visitante_nome = $solicitacao_visitante->nome;

        try {
            DB::beginTransaction();

            $solicitacao_visitante->delete();

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
            $request->session()->flash('message.content', 'A Solicitação <code class="highlighter-rouge">'. $solicitacao_visitante_nome .'</code> foi excluída com sucesso');
        }

        return redirect()->route('solicitacao_visitante.index');
    }

}
