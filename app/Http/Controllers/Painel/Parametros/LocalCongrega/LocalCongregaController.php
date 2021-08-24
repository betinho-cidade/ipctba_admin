<?php

namespace App\Http\Controllers\Painel\Parametros\LocalCongrega;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\LocalCongrega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\LocalCongrega\CreateRequest;
use App\Http\Requests\Parametros\LocalCongrega\UpdateRequest;
use Image;



class LocalCongregaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_local_congrega')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $local_congregas = LocalCongrega::all();

        return view('painel.parametros.local_congrega.index', compact('user', 'local_congregas'));
    }



    public function create()
    {
        if(Gate::denies('create_local_congrega')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.local_congrega.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_local_congrega')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $local_congrega = new LocalCongrega();

            $local_congrega->nome = $request->nome;

            $local_congrega->save();

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
            $request->session()->flash('message.content', 'O Local de Congregação <code class="highlighter-rouge">'. $local_congrega->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('local_congrega.index');
    }



    public function show(LocalCongrega $local_congrega)
    {

        if(Gate::denies('edit_local_congrega')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.local_congrega.show', compact('user', 'local_congrega'));
    }



    public function update(UpdateRequest $request, LocalCongrega $local_congrega)
    {
        if(Gate::denies('edit_local_congrega')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $local_congrega->nome = $request->nome;

            $local_congrega->save();

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
            $request->session()->flash('message.content', 'O Local de Congregação <code class="highlighter-rouge">'. $local_congrega->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('local_congrega.index');
    }



    public function destroy(LocalCongrega $local_congrega, Request $request)
    {
        if(Gate::denies('delete_local_congrega')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $local_congrega_nome = $local_congrega->nome;

        try {
            DB::beginTransaction();

            $local_congrega->delete();

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
            $request->session()->flash('message.content', 'O Local de Congregação <code class="highlighter-rouge">'. $local_congrega_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('local_congrega.index');
    }

}
