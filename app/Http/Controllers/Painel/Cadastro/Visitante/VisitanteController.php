<?php

namespace App\Http\Controllers\Painel\Cadastro\Visitante;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\Visitante;
use App\Models\FichaVisitante;
use App\Models\FichaVisitanteProcesso;
use App\Models\SolicitacaoVisitante;
use App\Models\ProcessoVisitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Visitante\UpdateRequest;
use App\Exports\MembrosExport;
use Image;
use Carbon\Carbon;
use Excel;
use PDF;


class VisitanteController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_ficha_visitante')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $roles = $user->roles;

        $visitantes = Visitante::where(function($query) use ($roles, $user){
                                    if($roles->contains('name', 'Lider')){
                                        $query->where('lider_id', $user->id);
                                    }
                                })
                                ->orderBy('nome', 'desc')
                                ->get();

        return view('painel.cadastro.visitante.index', compact('user', 'visitantes'));
    }

    public function show(Visitante $visitante, Request $request)
    {

        if(Gate::denies('view_ficha_visitante')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->contains('name', 'Lider') && $visitante->lider_id != $user->id){
            $message = 'A Ficha do Visitante escolhida foi disponibilizada para outro Lider.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('visitante.index');                                        
        }        

        $liders = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                        ->where('role_user.status', 'A')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->where('roles.name', 'Lider')
                        ->where(function($query) use ($roles, $user){
                                if($roles->contains('name', 'Lider')){
                                    $query->where('users.id', $user->id);
                                }
                            })
                        ->select('users.*')
                        ->get();

        $membros = Membro::whereIn('tipo_membro', ['CM', 'NC'])
                          ->where('status', 'A')
                          ->orderBy('nome')
                          ->get();                        

        return view('painel.cadastro.visitante.show', compact('user', 'visitante', 'liders', 'membros'));
    }

    public function update(UpdateRequest $request, Visitante $visitante)
    {
        if(Gate::denies('edit_ficha_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->contains('name', 'Lider') && $visitante->lider_id != $user->id){
            $message = 'A Ficha do Visitante escolhida foi disponibilizada para outro Lider.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('visitante.index');                                        
        }                

        if($request->situacao != 'AB' && !$request->lider && !$roles->contains('name', 'Lider')){
            $message = 'É necessário informar um Líder, antes de movimentar a Ficha do Visitante.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('visitante.show', compact('visitante'));
        }        

        $message = '';

        $lider_id = ($roles->contains('name', 'Lider')) ? $user->id : $request->lider; 
        $lider = ($lider_id) ? Membro::where('user_id', $lider_id)->first() : null;

        if(!$lider){
            $message = 'O Líder referenciado na Ficha de Visitante, não existe ou não foi definido corretamente no cadastro de membro.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('visitante.show', compact('visitante'));
        }        

        try {

            DB::beginTransaction();

            if($lider){
                $visitante->lider_id = $lider->user_id;
                $visitante->status = $request->situacao;
            }

            $visitante->membro_id = ($request->membro) ? $request->membro : null;

            $visitante->status = $request->situacao;
            $visitante->tipo_visitante = $request->tipo_visitante;
            $visitante->nome = $request->nome;
            $visitante->email_visitante = $request->email_visitante;
            $visitante->celular = $request->celular;
            $visitante->sexo = $request->sexo;
            $visitante->data_nascimento = $request->data_nascimento;
            $visitante->end_cep = $request->end_cep;
            $visitante->end_cidade = $request->end_cidade;
            $visitante->end_uf = $request->end_uf;
            $visitante->end_logradouro = $request->end_logradouro;
            $visitante->end_numero = $request->end_numero;
            $visitante->end_bairro = $request->end_bairro;
            $visitante->end_complemento = $request->end_complemento;
            $visitante->igreja_frequenta = $request->igreja_frequenta;
            $visitante->igreja_cidade = $request->igreja_cidade;
           
            $visitante->save();

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
            $request->session()->flash('message.content', 'A Ficha do Visitante <code class="highlighter-rouge">'. $visitante->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('visitante.index');
    }

    public function destroy(FichaVisitante $ficha_visitante, Request $request)
    {
        if(Gate::denies('delete_ficha_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        if($ficha_visitante->status == 'C'){
            $message = 'A Ficha de Atualização já foi concluída. Não pode ser excluída.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('ficha_visitante.index');
        }

        try {
            DB::beginTransaction();

            $ficha_visitante->delete();

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
            $request->session()->flash('message.content', 'A Ficha de Atualização foi excluída com sucesso');
        }

        return redirect()->route('visitante.index');
    }

    public function processos(Request $request, Visitante $visitante)
    {
        if(Gate::denies('edit_ficha_visitante')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->contains('name', 'Lider') && $visitante->lider_id != $user->id){
            $message = 'A Ficha do Visitante escolhida foi disponibilizada para outro Lider.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('visitante.index');                                        
        }               

        $message = '';

        try {

            DB::beginTransaction();

            $solicitacao_visitantes = SolicitacaoVisitante::get();
            foreach($solicitacao_visitantes as $solicitacao_visitante){

                foreach($solicitacao_visitante->processo_visitantes as $processo_visitante){

                    $ficha_visitante = FichaVisitante::where('visitante_id', $visitante->id)
                                                    ->where('solicitacao_visitante_id', $solicitacao_visitante->id)
                                                    ->first();
                  
                    if($ficha_visitante && $request->has('processo_'.$processo_visitante->id)){
                        
                        $ficha_processo = FichaVisitanteProcesso::where('ficha_visitante_id', $ficha_visitante->id)
                                                                ->where('processo_visitante_id', $processo_visitante->id)
                                                                ->first();                                                
                        if(!$ficha_processo){
                            $new_ficha_processo = new FichaVisitanteProcesso();
                            $new_ficha_processo->ficha_visitante_id = $ficha_visitante->id;
                            $new_ficha_processo->processo_visitante_id = $processo_visitante->id;
                            $new_ficha_processo->data_processo = Carbon::now();
                            $new_ficha_processo->anotacao = ($request->has('anotacao_'.$processo_visitante->id)) ? $request->get('anotacao_'.$processo_visitante->id) : null;
                            $new_ficha_processo->save();
                        } else{
                            $ficha_processo->data_processo = Carbon::now();
                            $ficha_processo->anotacao = ($request->has('anotacao_'.$processo_visitante->id)) ? $request->get('anotacao_'.$processo_visitante->id) : null;
                            $ficha_processo->save();
                        }
                    } else if($ficha_visitante && !$request->has('processo_'.$processo_visitante->id)){
                            FichaVisitanteProcesso::where('ficha_visitante_id', $ficha_visitante->id)
                                                ->where('processo_visitante_id', $processo_visitante->id)
                                                ->delete();   
                    }
                }
            }


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
            $request->session()->flash('message.content', 'A Ficha do Visitante <code class="highlighter-rouge">'. $visitante->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('visitante.index');
    }


}
