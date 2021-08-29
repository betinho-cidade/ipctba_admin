<?php

namespace App\Http\Controllers\Painel\Cadastro\Membro\HistoricoSolicitacao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\TipoSolicitacao;
use App\Models\HistoricoSolicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Membro\HistoricoSolicitacao\CreateRequest;
use App\Http\Requests\Cadastro\Membro\HistoricoSolicitacao\UpdateRequest;
use Image;



class HistoricoSolicitacaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function create(Membro $membro)
    {
        if(Gate::denies('create_historico')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $tipo_solicitacaos = TipoSolicitacao::all();

        $liders = Membro::all();

        return view('painel.cadastro.membro.historico_solicitacao.create', compact('user', 'membro', 'tipo_solicitacaos', 'liders'));
    }



    public function store(Membro $membro, CreateRequest $request)
    {
        if(Gate::denies('create_historico')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $historico_solicitacao = new HistoricoSolicitacao();

            $historico_solicitacao->membro_id = $membro->id;
            $historico_solicitacao->lider_id = $request->lider;
            $historico_solicitacao->tipo_solicitacao_id = $request->tipo_solicitacao;
            $historico_solicitacao->data_solicitacao = $request->data_solicitacao;
            $historico_solicitacao->data_realizacao = $request->data_realizacao;
            $historico_solicitacao->comentario = $request->comentario;

            $historico_solicitacao->save();

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
            $request->session()->flash('message.content', 'O Histórico da Solicitação <code class="highlighter-rouge">'. $historico_solicitacao->tipo_solicitacao->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }



    public function show(Membro $membro, HistoricoSolicitacao $historico_solicitacao)
    {

        if(Gate::denies('edit_historico')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $liders = Membro::all();

        return view('painel.cadastro.membro.historico_solicitacao.show', compact('user', 'membro', 'liders', 'historico_solicitacao'));
    }



    public function update(UpdateRequest $request, Membro $membro, HistoricoSolicitacao $historico_solicitacao)
    {
        if(Gate::denies('edit_historico')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $historico_solicitacao->lider_id = $request->lider;
            $historico_solicitacao->data_realizacao = $request->data_realizacao;
            $historico_solicitacao->comentario = $request->comentario;

            $historico_solicitacao->save();

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
            $request->session()->flash('message.content', 'O Histórico da Solicitação <code class="highlighter-rouge">'. $historico_solicitacao->tipo_solicitacao->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }



    public function destroy(Membro $membro, HistoricoSolicitacao $historico_solicitacao, Request $request)
    {
        if(Gate::denies('delete_historico')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $tipo_solicitacao_nome = $historico_solicitacao->tipo_solicitacao->nome;

        try {
            DB::beginTransaction();

            $historico_solicitacao->delete();

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
            $request->session()->flash('message.content', 'O Histórico da Solicitação <code class="highlighter-rouge">'. $tipo_solicitacao_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }

}
