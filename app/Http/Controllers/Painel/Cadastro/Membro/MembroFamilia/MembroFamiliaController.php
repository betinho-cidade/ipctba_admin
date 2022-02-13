<?php

namespace App\Http\Controllers\Painel\Cadastro\Membro\MembroFamilia;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\MembroFamilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Membro\MembroFamilia\CreateRequest;
use Image;



class MembroFamiliaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function create(Membro $membro)
    {
        if(Gate::denies('create_historico_familiar')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $membro_familias = MembroFamilia::where('membro_id', $membro->id)
                                         ->get();


        $novo_membros = Membro::where(function($query) use ($membro_familias){
                                if($membro_familias->count() > 0){
                                    $query->whereNotIn('id', [$membro_familias->pluck('membro_familia_id')]);
                                }
                                })
                                ->orderBy('nome')
                                ->get();

        return view('painel.cadastro.membro.membro_familia.create', compact('user', 'membro', 'novo_membros'));
    }



    public function store(Membro $membro, CreateRequest $request)
    {
        if(Gate::denies('create_historico_familiar')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $membro_familia = new MembroFamilia();

            $membro_familia->membro_id = $membro->id;
            $membro_familia->membro_familia_id = $request->membro_familia;
            $membro_familia->vinculo = $request->vinculo;

            $membro_familia->save();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            if(strpos($ex->getMessage(), 'membro_familia_uk') !== false){
                $message = "Já existe um vínculo registrado com os valores informados.";
            } else{
                $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ".$ex->getMessage();
            }
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Vínculo Familiar <code class="highlighter-rouge">'. $membro_familia->vinculo_familiar .'</code> foi criado com sucesso');
        }

        return redirect()->route('membro_familia.create', compact('membro'));
    }



    public function destroy(Membro $membro, MembroFamilia $membro_familia, Request $request)
    {
        if(Gate::denies('delete_historico_familiar')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $vinculo_nome = $membro_familia->vinculo_familiar;

        try {
            DB::beginTransaction();

            $membro_familia->delete();

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
            $request->session()->flash('message.content', 'O Vinculo Familiar <code class="highlighter-rouge">'. $vinculo_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('membro.show', compact('membro'));
    }

}
