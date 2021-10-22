<?php

namespace App\Http\Controllers\Painel\Parametros\TipoSolicitacao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\TipoSolicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\TipoSolicitacao\CreateRequest;
use App\Http\Requests\Parametros\TipoSolicitacao\UpdateRequest;
use Image;



class TipoSolicitacaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_tipo_solicitacao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $tipo_solicitacaos = TipoSolicitacao::all();

        return view('painel.parametros.tipo_solicitacao.index', compact('user', 'tipo_solicitacaos'));
    }



    public function create()
    {
        if(Gate::denies('create_tipo_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.tipo_solicitacao.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_tipo_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $tipo_solicitacao = new TipoSolicitacao();

            $tipo_solicitacao->nome = $request->nome;

            $tipo_solicitacao->save();

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
            $request->session()->flash('message.content', 'O Tipo de Solicitação <code class="highlighter-rouge">'. $tipo_solicitacao->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('tipo_solicitacao.index');
    }



    public function show(TipoSolicitacao $tipo_solicitacao)
    {

        if(Gate::denies('edit_tipo_solicitacao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.tipo_solicitacao.show', compact('user', 'tipo_solicitacao'));
    }



    public function update(UpdateRequest $request, TipoSolicitacao $tipo_solicitacao)
    {
        if(Gate::denies('edit_tipo_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $tipo_solicitacao->nome = $request->nome;

            $tipo_solicitacao->save();

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
            $request->session()->flash('message.content', 'O Tipo de Solicitação <code class="highlighter-rouge">'. $tipo_solicitacao->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('tipo_solicitacao.index');
    }



    public function destroy(TipoSolicitacao $tipo_solicitacao, Request $request)
    {
        if(Gate::denies('delete_tipo_solicitacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $tipo_solicitacao_nome = $tipo_solicitacao->nome;

        try {
            DB::beginTransaction();

            $tipo_solicitacao->delete();

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
            $request->session()->flash('message.content', 'O Tipo de Solicitação <code class="highlighter-rouge">'. $tipo_solicitacao_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('tipo_solicitacao.index');
    }

}
