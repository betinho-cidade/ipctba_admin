<?php

namespace App\Http\Controllers\Painel\Parametros\MeioAdmissao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\MeioAdmissao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\MeioAdmissao\CreateRequest;
use App\Http\Requests\Parametros\MeioAdmissao\UpdateRequest;
use Image;



class MeioAdmissaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_meio_admissao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $meio_admissaos = MeioAdmissao::all();

        return view('painel.parametros.meio_admissao.index', compact('user', 'meio_admissaos'));
    }



    public function create()
    {
        if(Gate::denies('create_meio_admissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.meio_admissao.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_meio_admissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $meio_admissao = new MeioAdmissao();

            $meio_admissao->nome = $request->nome;

            $meio_admissao->save();

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
            $request->session()->flash('message.content', 'O Meio de Admissão <code class="highlighter-rouge">'. $meio_admissao->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('meio_admissao.index');
    }



    public function show(MeioAdmissao $meio_admissao)
    {

        if(Gate::denies('edit_meio_admissao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.meio_admissao.show', compact('user', 'meio_admissao'));
    }



    public function update(UpdateRequest $request, MeioAdmissao $meio_admissao)
    {
        if(Gate::denies('edit_meio_admissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $meio_admissao->nome = $request->nome;

            $meio_admissao->save();

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
            $request->session()->flash('message.content', 'O Meio de Admissão <code class="highlighter-rouge">'. $meio_admissao->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('meio_admissao.index');
    }



    public function destroy(MeioAdmissao $meio_admissao, Request $request)
    {
        if(Gate::denies('delete_meio_admissao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $meio_admissao_nome = $meio_admissao->nome;

        try {
            DB::beginTransaction();

            $meio_admissao->delete();

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
            $request->session()->flash('message.content', 'O Meio de Admissão <code class="highlighter-rouge">'. $meio_admissao_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('meio_admissao.index');
    }

}
