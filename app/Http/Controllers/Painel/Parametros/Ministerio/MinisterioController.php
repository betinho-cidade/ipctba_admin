<?php

namespace App\Http\Controllers\Painel\Parametros\Ministerio;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Ministerio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\Ministerio\CreateRequest;
use App\Http\Requests\Parametros\Ministerio\UpdateRequest;
use Image;



class MinisterioController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_ministerio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $ministerios = Ministerio::all();

        return view('painel.parametros.ministerio.index', compact('user', 'ministerios'));
    }



    public function create()
    {
        if(Gate::denies('create_ministerio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.ministerio.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_ministerio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $ministerio = new Ministerio();

            $ministerio->nome = $request->nome;

            $ministerio->save();

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
            $request->session()->flash('message.content', 'O Ministério <code class="highlighter-rouge">'. $ministerio->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('ministerio.index');
    }



    public function show(Ministerio $ministerio)
    {

        if(Gate::denies('edit_ministerio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.ministerio.show', compact('user', 'ministerio'));
    }



    public function update(UpdateRequest $request, Ministerio $ministerio)
    {
        if(Gate::denies('edit_ministerio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $ministerio->nome = $request->nome;

            $ministerio->save();

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
            $request->session()->flash('message.content', 'O Ministério <code class="highlighter-rouge">'. $ministerio->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('ministerio.index');
    }



    public function destroy(Ministerio $ministerio, Request $request)
    {
        if(Gate::denies('delete_ministerio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $ministerio_nome = $ministerio->nome;

        try {
            DB::beginTransaction();

            $ministerio->delete();

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
            $request->session()->flash('message.content', 'O Ministério <code class="highlighter-rouge">'. $ministerio_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('ministerio.index');
    }

}
