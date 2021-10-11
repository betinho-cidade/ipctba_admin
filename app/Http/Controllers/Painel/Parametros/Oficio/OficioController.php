<?php

namespace App\Http\Controllers\Painel\Parametros\Oficio;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Oficio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Parametros\Oficio\CreateRequest;
use App\Http\Requests\Parametros\Oficio\UpdateRequest;
use Image;



class OficioController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_oficio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $oficios = Oficio::all();

        return view('painel.parametros.oficio.index', compact('user', 'oficios'));
    }



    public function create()
    {
        if(Gate::denies('create_oficio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        return view('painel.parametros.oficio.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_oficio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $oficio = new Oficio();

            $oficio->nome = $request->nome;

            $oficio->save();

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
            $request->session()->flash('message.content', 'O Ofício <code class="highlighter-rouge">'. $oficio->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('oficio.index');
    }



    public function show(Oficio $oficio)
    {

        if(Gate::denies('edit_oficio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.parametros.oficio.show', compact('user', 'oficio'));
    }



    public function update(UpdateRequest $request, Oficio $oficio)
    {
        if(Gate::denies('edit_oficio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $oficio->nome = $request->nome;

            $oficio->save();

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
            $request->session()->flash('message.content', 'O Ofício <code class="highlighter-rouge">'. $oficio->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('oficio.index');
    }



    public function destroy(Oficio $oficio, Request $request)
    {
        if(Gate::denies('delete_oficio')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $oficio_nome = $oficio->nome;

        try {
            DB::beginTransaction();

            $oficio->delete();

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
            $request->session()->flash('message.content', 'O Ofício <code class="highlighter-rouge">'. $oficio_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('oficio.index');
    }

}
