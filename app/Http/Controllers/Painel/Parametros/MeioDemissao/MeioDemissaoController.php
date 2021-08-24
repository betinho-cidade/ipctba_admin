<?php

namespace App\Http\Controllers\Painel\Parametros\MeioDemissao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\MeioDemissao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\MeioDemissao\CreateRequest;
use App\Http\Requests\Parametros\MeioDemissao\UpdateRequest;
use Image;



class MeioDemissaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_meio_demissao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $meio_demissaos = MeioDemissao::all();

        return view('painel.parametros.meio_demissao.index', compact('user', 'meio_demissaos'));
    }



    public function create()
    {
        if(Gate::denies('create_meio_demissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.meio_demissao.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_meio_demissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $meio_demissao = new MeioDemissao();

            $meio_demissao->nome = $request->nome;

            $meio_demissao->save();

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
            $request->session()->flash('message.content', 'O Meio de Demissão <code class="highlighter-rouge">'. $meio_demissao->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('meio_demissao.index');
    }



    public function show(MeioDemissao $meio_demissao)
    {

        if(Gate::denies('edit_meio_demissao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.meio_demissao.show', compact('user', 'meio_demissao'));
    }



    public function update(UpdateRequest $request, MeioDemissao $meio_demissao)
    {
        if(Gate::denies('edit_meio_demissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $meio_demissao->nome = $request->nome;

            $meio_demissao->save();

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
            $request->session()->flash('message.content', 'O Meio de Demissão <code class="highlighter-rouge">'. $meio_demissao->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('meio_demissao.index');
    }



    public function destroy(MeioDemissao $meio_demissao, Request $request)
    {
        if(Gate::denies('delete_meio_demissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $meio_demissao_nome = $meio_demissao->nome;

        try {
            DB::beginTransaction();

            $meio_demissao->delete();

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
            $request->session()->flash('message.content', 'O Meio de Demissão <code class="highlighter-rouge">'. $meio_demissao_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('meio_demissao.index');
    }

}
