<?php

namespace App\Http\Controllers\Painel\Cadastro\Membro\HistoricoOficio;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\Oficio;
use App\Models\HistoricoOficio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Membro\HistoricoOficio\CreateRequest;
use App\Http\Requests\Cadastro\Membro\HistoricoOficio\UpdateRequest;
use Image;



class HistoricoOficioController extends Controller
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

        $oficios = Oficio::all();

        return view('painel.cadastro.membro.historico_oficio.create', compact('user', 'membro', 'oficios'));
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

            $historico_oficio = new HistoricoOficio();

            $historico_oficio->membro_id = $membro->id;
            $historico_oficio->oficio_id = $request->oficio;
            $historico_oficio->data_inicio = $request->data_inicio;
            $historico_oficio->data_fim = $request->data_fim;
            $historico_oficio->comentario = $request->comentario;

            $historico_oficio->save();

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
            $request->session()->flash('message.content', 'O Histórico do Ofício <code class="highlighter-rouge">'. $historico_oficio->oficio->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }



    public function show(Membro $membro, HistoricoOficio $historico_oficio)
    {

        if(Gate::denies('edit_historico')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return view('painel.cadastro.membro.historico_oficio.show', compact('user', 'membro', 'historico_oficio'));
    }



    public function update(UpdateRequest $request, Membro $membro, HistoricoOficio $historico_oficio)
    {
        if(Gate::denies('edit_historico')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $historico_oficio->data_fim = $request->data_fim;
            $historico_oficio->comentario = $request->comentario;

            $historico_oficio->save();

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
            $request->session()->flash('message.content', 'O Histórico do Ofício <code class="highlighter-rouge">'. $historico_oficio->oficio->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }



    public function destroy(Membro $membro, HistoricoOficio $historico_oficio, Request $request)
    {
        if(Gate::denies('delete_historico')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $oficio_nome = $historico_oficio->oficio->nome;

        try {
            DB::beginTransaction();

            $historico_oficio->delete();

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
            $request->session()->flash('message.content', 'O Histórico do Ofício <code class="highlighter-rouge">'. $oficio_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }

}
