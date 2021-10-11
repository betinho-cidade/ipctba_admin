<?php

namespace App\Http\Controllers\Painel\Cadastro\MembroFicha;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\MembroFicha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\MembroFicha\CreateRequest;
use App\Http\Requests\Cadastro\MembroFicha\UpdateRequest;
use App\Exports\MembrosExport;
use Image;
use Carbon\Carbon;
use Excel;
use PDF;


class MembroFichaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_membro_ficha')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $membro_fichas = MembroFicha::orderBy('nome', 'desc')
                                      ->get();

        return view('painel.cadastro.membro_ficha.index', compact('user', 'membro_fichas'));
    }


    public function create(Request $request)
    {
        if(Gate::denies('create_membro_ficha')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $membros = Membro::whereIn('tipo_membro', ['CM', 'NC'])
                          ->where('status', 'A')
                          ->get();

        $membro = '';
        $membro_sol = ($request->membro_sol) ? $request->membro_sol : -1;

        if($request->membro_sol){
            $membro = Membro::where('id', $request->membro_sol)->first();
        }

        return view('painel.cadastro.membro_ficha.create', compact('user', 'membros', 'membro', 'membro_sol'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_membro_ficha')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $membro_ficha = new MembroFicha();

            $membro_ficha->lider_id = $request->lider;
            $membro_ficha->membro_id = $request->membro_sol;
            $membro_ficha->nome = $request->nome;
            $membro_ficha->email = $request->email_membro;
            $membro_ficha->celular = $request->celular;
            $membro_ficha->data_nascimento = $request->data_nascimento;
            $membro_ficha->naturalidade = $request->naturalidade;
            $membro_ficha->conjuge = $request->conjuge;
            $membro_ficha->data_casamento = $request->data_casamento;
            $membro_ficha->profissao = $request->profissao;
            $membro_ficha->nome_pai = $request->nome_pai;
            $membro_ficha->nome_mae = $request->nome_mae;
            $membro_ficha->end_cep = $request->end_cep;
            $membro_ficha->end_cidade = $request->end_cidade;
            $membro_ficha->end_uf = $request->end_uf;
            $membro_ficha->end_logradouro = $request->end_logradouro;
            $membro_ficha->end_numero = $request->end_numero;
            $membro_ficha->end_bairro = $request->end_bairro;
            $membro_ficha->end_complemento = $request->end_complemento;
            $membro_ficha->estado_civil = $request->estado_civil;
            $membro_ficha->escolaridade = $request->escolaridade;
            $membro_ficha->status = 'AL';

            $membro_ficha->save();

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
            $request->session()->flash('message.content', 'A Ficha de Atualização de Cadastro do membro <code class="highlighter-rouge">'. $membro_ficha->membro->nome .'</code> foi criada com sucesso');
        }

        return redirect()->route('membro_ficha.index');
    }


    public function show(MembroFicha $membro_ficha, Request $request)
    {

        if(Gate::denies('view_membro_ficha')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $membros = Membro::whereIn('tipo_membro', ['CM', 'NC'])
                          ->where('status', 'A')
                          ->get();

        $membro = '';
        $membro_sol = ($request->membro_sol) ? $request->membro_sol : $membro_ficha->membro_id;

        $membro = Membro::where('id', $membro_sol)->first();

        return view('painel.cadastro.membro_ficha.show', compact('user', 'membro_ficha', 'membros', 'membro', 'membro_sol'));
    }


    public function update(UpdateRequest $request, MembroFicha $membro_ficha)
    {
        if(Gate::denies('edit_membro_ficha')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        if($membro_ficha->status == 'C'){
            $message = 'A Ficha de Atualização já foi concluída. Não pode mais ser alterada.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('membro_ficha.index');
        }

        try {

            $membro_sol = ($membro_ficha->status == 'AS') ? $request->membro_sol : $membro_ficha->membro_id;
            $membro = Membro::where('id', $membro_sol)->first();

            if(!$membro){
                $message = 'O Membro referenciado na Ficha de Atualização, não existe ou não foi definido corretamente.';
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', $message);

                return redirect()->route('membro_ficha.index');
            }

            DB::beginTransaction();

            $membro_ficha->membro_id = $membro_sol;
            $membro_ficha->nome = $request->nome;
            $membro_ficha->email = $request->email_membro;
            $membro_ficha->celular = $request->celular;
            $membro_ficha->data_nascimento = $request->data_nascimento;
            $membro_ficha->naturalidade = $request->naturalidade;
            $membro_ficha->conjuge = $request->conjuge;
            $membro_ficha->data_casamento = $request->data_casamento;
            $membro_ficha->profissao = $request->profissao;
            $membro_ficha->nome_pai = $request->nome_pai;
            $membro_ficha->nome_mae = $request->nome_mae;
            $membro_ficha->end_cep = $request->end_cep;
            $membro_ficha->end_cidade = $request->end_cidade;
            $membro_ficha->end_uf = $request->end_uf;
            $membro_ficha->end_logradouro = $request->end_logradouro;
            $membro_ficha->end_numero = $request->end_numero;
            $membro_ficha->end_bairro = $request->end_bairro;
            $membro_ficha->end_complemento = $request->end_complemento;
            $membro_ficha->estado_civil = $request->estado_civil;
            $membro_ficha->escolaridade = $request->escolaridade;
            $membro_ficha->status = 'C';

            $membro_ficha->save();

            if ($membro_ficha->nome) { $membro->nome = $membro_ficha->nome;}
            if ($membro_ficha->email) { $membro->email = $membro_ficha->email;}
            if ($membro_ficha->celular) { $membro->celular = $membro_ficha->celular;}
            if ($membro_ficha->data_nascimento) { $membro->data_nascimento = $membro_ficha->data_nascimento;}
            if ($membro_ficha->naturalidade) { $membro->naturalidade = $membro_ficha->naturalidade;}
            if ($membro_ficha->conjuge) { $membro->conjuge = $membro_ficha->conjuge;}
            if ($membro_ficha->data_casamento) { $membro->data_casamento = $membro_ficha->data_casamento;}
            if ($membro_ficha->profissao) { $membro->profissao = $membro_ficha->profissao;}
            if ($membro_ficha->nome_pai) { $membro->nome_pai = $membro_ficha->nome_pai;}
            if ($membro_ficha->nome_mae) { $membro->nome_mae = $membro_ficha->nome_mae;}
            if ($membro_ficha->end_cep) { $membro->end_cep = $membro_ficha->end_cep;}
            if ($membro_ficha->end_cidade) { $membro->end_cidade = $membro_ficha->end_cidade;}
            if ($membro_ficha->end_uf) { $membro->end_uf = $membro_ficha->end_uf;}
            if ($membro_ficha->end_logradouro) { $membro->end_logradouro = $membro_ficha->end_logradouro;}
            if ($membro_ficha->end_numero) { $membro->end_numero = $membro_ficha->end_numero;}
            if ($membro_ficha->end_bairro) { $membro->end_bairro = $membro_ficha->end_bairro;}
            if ($membro_ficha->end_complemento) { $membro->end_complemento = $membro_ficha->end_complemento;}
            if ($membro_ficha->estado_civil) { $membro->estado_civil = $membro_ficha->estado_civil;}
            if ($membro_ficha->nomescolaridadee) { $membro->escolaridade = $membro_ficha->escolaridade;}

            $membro->save();

            if ($membro_ficha->nome) {
                if($membro->user){
                    $membro->user->name = $membro_ficha->nome;
                    $membro->user->save();
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
            $request->session()->flash('message.content', 'O Membro <code class="highlighter-rouge">'. $membro->nome .'</code> foi alterado com sucesso');
        }

        return redirect()->route('membro_ficha.index');
    }


    public function destroy(MembroFicha $membro_ficha, Request $request)
    {
        if(Gate::denies('delete_membro_ficha')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        if($membro_ficha->status == 'C'){
            $message = 'A Ficha de Atualização já foi concluída. Não pode ser excluída.';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('membro_ficha.index');
        }

        try {
            DB::beginTransaction();

            $membro_ficha->delete();

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

        return redirect()->route('membro_ficha.index');
    }

}
