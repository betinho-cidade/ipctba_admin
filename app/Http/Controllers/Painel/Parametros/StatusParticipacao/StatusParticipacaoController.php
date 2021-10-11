<?php

namespace App\Http\Controllers\Painel\Parametros\StatusParticipacao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\StatusParticipacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\StatusParticipacao\CreateRequest;
use App\Http\Requests\Parametros\StatusParticipacao\UpdateRequest;
use Image;



class StatusParticipacaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_status_participacao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $status_participacaos = StatusParticipacao::all();

        return view('painel.parametros.status_participacao.index', compact('user', 'status_participacaos'));
    }



    public function create()
    {
        if(Gate::denies('create_status_participacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.status_participacao.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_status_participacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $status_participacao = new StatusParticipacao();

            $status_participacao->nome = $request->nome;

            $status_participacao->save();

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
            $request->session()->flash('message.content', 'O Status de Participação <code class="highlighter-rouge">'. $status_participacao->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('status_participacao.index');
    }



    public function show(StatusParticipacao $status_participacao)
    {

        if(Gate::denies('edit_status_participacao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.status_participacao.show', compact('user', 'status_participacao'));
    }



    public function update(UpdateRequest $request, StatusParticipacao $status_participacao)
    {
        if(Gate::denies('edit_status_participacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $status_participacao->nome = $request->nome;

            $status_participacao->save();

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
            $request->session()->flash('message.content', 'O Status de Participação <code class="highlighter-rouge">'. $status_participacao->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('status_participacao.index');
    }



    public function destroy(StatusParticipacao $status_participacao, Request $request)
    {
        if(Gate::denies('delete_status_participacao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $status_participacao_nome = $status_participacao->nome;

        try {
            DB::beginTransaction();

            $status_participacao->delete();

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
            $request->session()->flash('message.content', 'O Status de Participação <code class="highlighter-rouge">'. $status_participacao_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('status_participacao.index');
    }

}
