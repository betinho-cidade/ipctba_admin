<?php

namespace App\Http\Controllers\Guest\Cadastro\FichaVisitante;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SolicitacaoVisitante;
use App\Models\Visitante;
use App\Models\FichaVisitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\FichaVisitante\CreateRequest;
use Image;
use Carbon\Carbon;


class FichaVisitanteController extends Controller
{

    public function create()
    {
        $solicitacao_visitantes = SolicitacaoVisitante::whereIn('origem', ['ES'])->get();

        return view('guest.cadastro.ficha_visitante.create', compact('solicitacao_visitantes'));
    }



    public function store(CreateRequest $request)
    {

        $message = '';

        try {

            DB::beginTransaction();

            $visitante = new Visitante();

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
            $visitante->status = 'AB';

            $visitante->save();

            $solicitacao_visitantes = SolicitacaoVisitante::get();

            foreach($solicitacao_visitantes as $solicitacao_visitante){

                if($solicitacao_visitante->origem == 'GR'){
                    $ficha_visitante = new FichaVisitante();
                    $ficha_visitante->visitante_id = $visitante->id;
                    $ficha_visitante->solicitacao_visitante_id = $solicitacao_visitante->id;
                    $ficha_visitante->save();
                }else{
                    if($request->has('solicitacao_'.$solicitacao_visitante->id)){
                        $ficha_visitante = new FichaVisitante();
                        $ficha_visitante->visitante_id = $visitante->id;
                        $ficha_visitante->solicitacao_visitante_id = $solicitacao_visitante->id;
                        if($solicitacao_visitante->informar_motivo == 'S'){
                            if($request->has('informar_motivo_'.$solicitacao_visitante->id)){
                                $ficha_visitante->motivo = $request->get('informar_motivo_'.$solicitacao_visitante->id);
                            }
                        }

                        $ficha_visitante->save();
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
            $request->session()->flash('message.token', $request->_token);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Ficha de Visitante foi criada com sucesso');
        }


        return redirect()->route('ficha_visitante.ok', ['token' => $request->_token]);

    }


    public function ok(Request $request)
    {

        if($request->token && session()->has('message.token') && ($request->token === session('message.token'))){

            return view('guest.cadastro.ficha_visitante.ok');

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
