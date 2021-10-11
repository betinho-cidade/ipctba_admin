<?php

namespace App\Http\Controllers\Painel\Parametros\SituacaoMembro;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\SituacaoMembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\SituacaoMembro\CreateRequest;
use App\Http\Requests\Parametros\SituacaoMembro\UpdateRequest;
use Image;



class SituacaoMembroController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_situacao_membro')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $situacao_membros = SituacaoMembro::all();

        return view('painel.parametros.situacao_membro.index', compact('user', 'situacao_membros'));
    }



    public function create()
    {
        if(Gate::denies('create_situacao_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.situacao_membro.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_situacao_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $situacao_membro = new SituacaoMembro();

            $situacao_membro->nome = $request->nome;

            $situacao_membro->save();

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
            $request->session()->flash('message.content', 'A Situação do Membro <code class="highlighter-rouge">'. $situacao_membro->nome .'</code> foi criada com sucesso');
        }

        return redirect()->route('situacao_membro.index');
    }



    public function show(SituacaoMembro $situacao_membro)
    {

        if(Gate::denies('edit_situacao_membro')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.situacao_membro.show', compact('user', 'situacao_membro'));
    }



    public function update(UpdateRequest $request, SituacaoMembro $situacao_membro)
    {
        if(Gate::denies('edit_situacao_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $situacao_membro->nome = $request->nome;

            $situacao_membro->save();

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
            $request->session()->flash('message.content', 'A Situação do Membro <code class="highlighter-rouge">'. $situacao_membro->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('situacao_membro.index');
    }



    public function destroy(SituacaoMembro $situacao_membro, Request $request)
    {
        if(Gate::denies('delete_situacao_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $situacao_membro_nome = $situacao_membro->nome;

        try {
            DB::beginTransaction();

            $situacao_membro->delete();

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
            $request->session()->flash('message.content', 'A Situação do Membro <code class="highlighter-rouge">'. $situacao_membro_nome .'</code> foi excluída com sucesso');
        }

        return redirect()->route('situacao_membro.index');
    }

}
