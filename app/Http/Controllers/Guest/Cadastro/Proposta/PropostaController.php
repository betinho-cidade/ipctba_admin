<?php

namespace App\Http\Controllers\Guest\Cadastro\Proposta;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Paise;
use App\Models\PropostaAgrupador;
use App\Models\Proposta;
use App\Models\IdiomaSite;
use App\Models\IdiomaForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\Cadastro\Proposta\CreateRequest;
use Image;


class PropostaController extends Controller
{


    public function create(Request $request)
    {
        Auth()->logout();

        $paises = Paise::all();

        $idioma = $request->idioma;

        $idiomas = IdiomaSite::all()->pluck('sigla')->toArray();
        //$idiomas = ['EN', 'DE', 'PL', 'PT', 'ES'];

        if(!$idioma || !in_array($idioma, $idiomas)){
            abort('403', 'Página não disponível');
        }


        return view('guest.cadastro.proposta.create_'.$idioma, compact('paises', 'idioma'));
    }



    public function store(CreateRequest $request)
    {
        $message = '';

        try {

            DB::beginTransaction();

            $idioma = IdiomaSite::where('sigla', $request->idioma)->first();
            $proposta_agrupador = new PropostaAgrupador();
            $proposta_agrupador->idioma_site_id = $idioma->id;
            $proposta_agrupador->save();

            // SALVAR NO IDIOMA INGLÊS
            //----------------------------------

            $idioma_form_EN = IdiomaForm::where('sigla', 'EN')->first();
            $proposta_EN = new Proposta();
            $proposta_EN->proposta_agrupador_id = $proposta_agrupador->id;
            $proposta_EN->idioma_form_id = $idioma_form_EN->id;
            $proposta_EN->paise_id = $request->paise_EN;
            $proposta_EN->autor = $request->autor_EN;
            $proposta_EN->data = $request->data_EN;
            $proposta_EN->titulo = $request->titulo_EN;
            $proposta_EN->texto = $request->texto_EN;
            $proposta_EN->fundamentacao = $request->fundamentacao_EN;
            $proposta_EN->comentario = $request->comentario_EN;
            $proposta_EN->email = $request->email_EN;
            $proposta_EN->save();

            // SALVAR NO IDIOMA ALEMÃO
            //----------------------------------

            $idioma_form_DE = IdiomaForm::where('sigla', 'DE')->first();
            $proposta_DE = new Proposta();
            $proposta_DE->proposta_agrupador_id = $proposta_agrupador->id;
            $proposta_DE->idioma_form_id = $idioma_form_DE->id;
            $proposta_DE->paise_id = $request->paise_DE;
            $proposta_DE->autor = $request->autor_DE;
            $proposta_DE->data = $request->data_DE;
            $proposta_DE->titulo = $request->titulo_DE;
            $proposta_DE->texto = $request->texto_DE;
            $proposta_DE->fundamentacao = $request->fundamentacao_DE;
            $proposta_DE->comentario = $request->comentario_DE;
            $proposta_DE->email = $request->email_DE;
            $proposta_DE->save();

            // SALVAR NO IDIOMA ESPANHOL
            //----------------------------------

            $idioma_form_ES = IdiomaForm::where('sigla', 'ES')->first();
            $proposta_ES = new Proposta();
            $proposta_ES->proposta_agrupador_id = $proposta_agrupador->id;
            $proposta_ES->idioma_form_id = $idioma_form_ES->id;
            $proposta_ES->paise_id = $request->paise_ES;
            $proposta_ES->autor = $request->autor_ES;
            $proposta_ES->data = $request->data_ES;
            $proposta_ES->titulo = $request->titulo_ES;
            $proposta_ES->texto = $request->texto_ES;
            $proposta_ES->fundamentacao = $request->fundamentacao_ES;
            $proposta_ES->comentario = $request->comentario_ES;
            $proposta_ES->email = $request->email_ES;
            $proposta_ES->save();


            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ";
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('proposta.create', ['idioma' => $request->idioma])->withInput();
        } else {
            $request->session()->flash('message.token', $request->_token);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Sua proposta foi cadastrada com sucesso');
        }

        return redirect()->route('proposta.bemvindo', ['token' => $request->_token]);
    }


    public function bemvindo(Request $request)
    {

        if($request->token && session()->has('message.token') && ($request->token === session('message.token'))){

            return view('guest.cadastro.proposta.bemvindo');

        } else{
            Auth()->logout();
            abort('403', 'Página não disponível');
        }
    }

}
