<?php

namespace App\Http\Controllers\Painel\Cadastro\Membro\MembroFamilia;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\MembroFamilia;
use App\Models\MembroFilho;
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


    public function create(Membro $membro, Request $request)
    {
        if(Gate::denies('create_historico_familiar')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $membro_familias = MembroFamilia::where('membro_id', $membro->id)
                                         ->get();

        $novo_membros = Membro::where(function($query) use ($membro_familias){
                                if($membro_familias->count() > 0){
                                    $query->whereNotIn('id', $membro_familias->pluck('membro_familia_id'));
                                }
                                })
                                ->whereNotIn('id', [$membro->id])
                                ->orderBy('nome')
                                ->get();

        $vinculo = $request->has('vinculo') ? $request->vinculo : '';
        $name = $request->has('name') ? $request->name : '';
        $membro_filho = $request->has('membro_filho') ? $request->membro_filho : '';

        return view('painel.cadastro.membro.membro_familia.create', compact('user', 'membro', 'novo_membros', 'vinculo', 'name', 'membro_filho'));
    }



    public function store(Membro $membro, CreateRequest $request)
    {
        if(Gate::denies('create_historico_familiar')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        $vinculo = $request->has('vinculo') ? $request->vinculo : '';
        $name = $request->has('name') ? $request->name : '';        
        $membro_filho = $request->has('membro_filho') ? $request->membro_filho : '';
        $isMembroFilho = [];

        if ($membro_filho && $vinculo == 'F') {

            $isMembroFilho = MembroFilho::where('id', $membro_filho)
                                  ->first();            

            if(!$isMembroFilho || ($isMembroFilho->membro_id != $membro->id)){
                $message = 'O filho selecionado não possui relação com o membro em questão';
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', $message);
    
                return redirect()->route('membro_familia.create', ['membro'=>$membro->id, 'vinculo'=>$vinculo, 'name'=>$name, 'membro_filho'=>$membro_filho]);
            }
        }    

        $existe_vinculo = MembroFamilia::where('membro_id', $membro->id)
                                        ->where('vinculo', $request->vinculo)
                                        ->first();

        if ($existe_vinculo && $vinculo != 'F') {
            $message = 'Já existe um membro relacionado com o vínculo informado - ' . $existe_vinculo->vinculo_familiar . ' ('. $existe_vinculo->membro_familia->nome .')';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('membro_familia.create', ['membro'=>$membro->id, 'vinculo'=>$vinculo, 'name'=>$name]);
        }    
        

        try {

            DB::beginTransaction();

            $membro_familia = new MembroFamilia();

            $membro_familia->membro_id = $membro->id;
            $membro_familia->membro_familia_id = $request->membro_familia;
            $membro_familia->vinculo = $request->vinculo;

            $membro_familia->save();

            if($isMembroFilho){
                MembroFilho::where('id', $isMembroFilho->id)
                            ->delete();
            }

            $this->createVinculo($membro, $membro_familia->membro_familia_id, $membro_familia->vinculo);

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            if(strpos($ex->getMessage(), 'membro_familia_uk') !== false){
                
                $membro_familia = MembroFamilia::where('membro_id', $membro->id)
                                                ->where('membro_familia_id', $request->membro_familia)
                                                ->first();
                if(!$membro_familia){
                    $membro_familia = MembroFamilia::where('membro_id', $request->membro_familia)
                                                    ->where('membro_familia_id', $membro->id)
                                                    ->first();

                    $message = 'O vínculo recursivo com o Membro (<a href="' . route('membro.show', ['membro' => $membro_familia->membro_id]) . '" target="_blank">'.$membro_familia->membro->nome.'</a>) NÃO PODE ser realizado, pois já existe um vínculo - ' . $membro_familia->vinculo_familiar . ' ('. $membro_familia->membro_familia->nome .')';                                                    

                } else{
                    $message = 'Já existe um membro relacionado com o vínculo informado - ' . $membro_familia->vinculo_familiar . ' ('. $membro_familia->membro_familia->nome .')';
                }

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


    public function createVinculo(Membro $membro, String $membro_vinculo_id, String $vinculo){

        $membro_vinculo = Membro::where('id', $membro_vinculo_id)
                                  ->first();

        $membro_familia = new MembroFamilia();

        $membro_familia->membro_id = $membro_vinculo->id;
        $membro_familia->membro_familia_id = $membro->id;
        
        switch($vinculo){
            case 'C':
                $membro_familia->vinculo = $vinculo;
                break;
            case 'P':
            case 'M':
                $membro_familia->vinculo = 'F';
                break;
            case 'F':
                $membro_familia->vinculo = ($membro->sexo == 'M') ? 'P' : 'M';
                break;
        }

        $membro_familia->save();
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

            MembroFamilia::where('membro_id', $membro_familia->membro_familia_id)
                        ->where('membro_familia_id', $membro->id)
                        ->delete();

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
