<?php

namespace App\Http\Controllers\Painel\Cadastro\Membro\HistoricoSituacao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\SituacaoMembro;
use App\Models\HistoricoSituacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Membro\HistoricoSituacao\CreateRequest;
use App\Http\Requests\Cadastro\Membro\HistoricoSituacao\UpdateRequest;
use Image;



class HistoricoSituacaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function create(Membro $membro)
    {
        if(Gate::denies('create_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $situacao_membros = SituacaoMembro::all();

        return view('painel.cadastro.membro.historico_situacao.create', compact('user', 'membro', 'situacao_membros'));
    }



    public function store(Membro $membro, CreateRequest $request)
    {
        if(Gate::denies('create_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $historico_situacao = new HistoricoSituacao();

            $historico_situacao->membro_id = $membro->id;
            $historico_situacao->situacao_membro_id = $request->situacao_membro;
            $historico_situacao->data_inicio = $request->data_inicio;
            $historico_situacao->data_fim = $request->data_fim;
            $historico_situacao->comentario = $request->comentario;

            $historico_situacao->save();

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
            $request->session()->flash('message.content', 'O Histórico da Situação do Membro <code class="highlighter-rouge">'. $historico_situacao->situacao_membro->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }



    public function show(Membro $membro, HistoricoSituacao $historico_situacao)
    {

        if(Gate::denies('edit_membro')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.cadastro.membro.historico_situacao.show', compact('user', 'membro', 'historico_situacao'));
    }



    public function update(UpdateRequest $request, Membro $membro, HistoricoSituacao $historico_situacao)
    {
        if(Gate::denies('edit_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $historico_situacao->data_fim = $request->data_fim;
            $historico_situacao->comentario = $request->comentario;

            $historico_situacao->save();

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
            $request->session()->flash('message.content', 'O Histórico da Situação do Membro <code class="highlighter-rouge">'. $historico_situacao->situacao_membro->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }



    public function destroy(Membro $membro, HistoricoSituacao $historico_situacao, Request $request)
    {
        if(Gate::denies('delete_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $situacao_membro_nome = $historico_situacao->situacao_membro->nome;

        try {
            DB::beginTransaction();

            $historico_situacao->delete();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            if(strpos($ex->getMessage(), 'sIntegrity constraint violation') !== false){
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
            $request->session()->flash('message.content', 'O Histórico da Situação do Membro <code class="highlighter-rouge">'. $situacao_membro_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }

}
