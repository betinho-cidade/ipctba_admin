<?php

namespace App\Http\Controllers\Guest\Cadastro\FichaCadastro;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MembroFicha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\FichaCadastro\CreateRequest;
use Image;
use Carbon\Carbon;


class FichaCadastroController extends Controller
{

    public function create()
    {
        return view('guest.cadastro.ficha_cadastro.create');
    }



    public function store(CreateRequest $request)
    {

        $message = '';

        try {

            DB::beginTransaction();

            $membro_ficha = new MembroFicha();

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
            $membro_ficha->status = 'AS';

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
            $request->session()->flash('message.token', $request->_token);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Ficha de Atualização de Cadastro foi criada com sucesso');
        }


        return redirect()->route('ficha_cadastro.ok', ['token' => $request->_token]);

    }


    public function ok(Request $request)
    {

        if($request->token && session()->has('message.token') && ($request->token === session('message.token'))){

            return view('guest.cadastro.ficha_cadastro.ok');

        } else{

            Auth()->logout();
            return redirect()->route('login');
        }
    }


    public function js_viacep(Request $request)
    {

        $cep = Str::of($request->cep)->replaceMatches('/[^z0-9]++/', '')->__toString();

        $url = 'https://viacep.com.br/ws/'. $cep .'/json/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 3);

        $result = curl_exec($ch);

        curl_close($ch);

        $mensagem = json_decode($result,true);

        echo json_encode($mensagem);
    }

}
