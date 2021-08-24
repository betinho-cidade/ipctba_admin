<?php

namespace App\Http\Controllers\Guest\Cadastro\Capitular;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Paise;
use App\Models\CapitularAgrupador;
use App\Models\Capitular;
use App\Models\IdiomaSite;
use App\Models\IdiomaForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\Cadastro\Capitular\CreateRequest;
use Image;


class CapitularController extends Controller
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

        return view('guest.cadastro.capitular.create_'.$idioma, compact('paises', 'idioma'));
    }



    public function store(CreateRequest $request)
    {
        $message = '';

        try {

            DB::beginTransaction();

            $idioma = IdiomaSite::where('sigla', $request->idioma)->first();
            $capitular_agrupador = new CapitularAgrupador();
            $capitular_agrupador->idioma_site_id = $idioma->id;
            $capitular_agrupador->save();

            // SALVAR NO IDIOMA INGLÊS
            //----------------------------------

            $idioma_form_EN = IdiomaForm::where('sigla', 'EN')->first();
            $capitular_EN = new Capitular();
            $capitular_EN->capitular_agrupador_id = $capitular_agrupador->id;
            $capitular_EN->idioma_form_id = $idioma_form_EN->id;
            $capitular_EN->paise_id = $request->paise_EN;
            $capitular_EN->nome = $request->nome_EN;
            $capitular_EN->celular = $request->celular_EN;
            $capitular_EN->data_nascimento = $request->data_nascimento_EN;
            $capitular_EN->profissao = $request->profissao_EN;
            $capitular_EN->idioma = $request->idioma_EN;
            $capitular_EN->data_casamento = $request->data_casamento_EN;
            $capitular_EN->filho = $request->filho_EN;
            $capitular_EN->endereco = $request->endereco_EN;
            $capitular_EN->email = $request->email_EN;
            $capitular_EN->data_uniao_familia = $request->data_uniao_familia_EN;
            $capitular_EN->curso = $request->curso_EN;
            $capitular_EN->ideal_curso = $request->ideal_curso_EN;
            $capitular_EN->ano_consagracao = $request->ano_consagracao_EN;
            $capitular_EN->santuario = $request->santuario_EN;
            $capitular_EN->apostolado = $request->apostolado_EN;
            $capitular_EN->desejo_casal = $request->desejo_casal_EN;
            $capitular_EN->palavra = $request->palavra_EN;
            $capitular_EN->frase = $request->frase_EN;
            $capitular_EN->expectativa = $request->expectativa_EN;
            $capitular_EN->save();

            if($request->path_familia_01_EN){
                $img_familia_01_EN = 'familia_EN_01.'.$request->path_familia_01_EN->extension();
                $path_familia_01_EN = 'images/familia/'.$capitular_agrupador->id;

                $capitular_EN->path_familia_01 = $img_familia_01_EN;

                if(!\File::isDirectory(public_path('images/familia'))){
                    \File::makeDirectory('images/familia');
                }

                if(!\File::isDirectory(public_path($path_familia_01_EN))){
                    \File::makeDirectory($path_familia_01_EN);
                }

                $img = Image::make($request->path_familia_01_EN)->orientate();

                $img->resize(1800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_familia_01_EN.'/'.$img_familia_01_EN, 80);
                //$img->save($path_evidencia, 60);

                $capitular_EN->save();
            }

            if($request->path_familia_02_EN){
                $img_familia_02_EN = 'familia_EN_02.'.$request->path_familia_02_EN->extension();
                $path_familia_02_EN = 'images/familia/'.$capitular_agrupador->id;

                $capitular_EN->path_familia_02 = $img_familia_02_EN;

                if(!\File::isDirectory(public_path('images/familia'))){
                    \File::makeDirectory('images/familia');
                }

                if(!\File::isDirectory(public_path($path_familia_02_EN))){
                    \File::makeDirectory($path_familia_02_EN);
                }

                $img = Image::make($request->path_familia_02_EN)->orientate();

                $img->resize(1800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_familia_02_EN.'/'.$img_familia_02_EN, 80);
                //$img->save($path_evidencia, 60);

                $capitular_EN->save();
            }

            if($request->path_familia_03_EN){
                $img_familia_03_EN = 'familia_EN_03.'.$request->path_familia_03_EN->extension();
                $path_familia_03_EN = 'images/familia/'.$capitular_agrupador->id;

                $capitular_EN->path_familia_03 = $img_familia_03_EN;

                if(!\File::isDirectory(public_path('images/familia'))){
                    \File::makeDirectory('images/familia');
                }

                if(!\File::isDirectory(public_path($path_familia_03_EN))){
                    \File::makeDirectory($path_familia_03_EN);
                }

                $img = Image::make($request->path_familia_03_EN)->orientate();

                $img->resize(1800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_familia_03_EN.'/'.$img_familia_03_EN, 80);
                //$img->save($path_evidencia, 60);

                $capitular_EN->save();
            }


            // SALVAR NO IDIOMA ALEMÃO
            //----------------------------------

            $idioma_form_DE = IdiomaForm::where('sigla', 'DE')->first();
            $capitular_DE = new Capitular();
            $capitular_DE->capitular_agrupador_id = $capitular_agrupador->id;
            $capitular_DE->idioma_form_id = $idioma_form_DE->id;
            $capitular_DE->paise_id = $request->paise_DE;
            $capitular_DE->nome = $request->nome_DE;
            $capitular_DE->celular = $request->celular_DE;
            $capitular_DE->data_nascimento = $request->data_nascimento_DE;
            $capitular_DE->profissao = $request->profissao_DE;
            $capitular_DE->idioma = $request->idioma_DE;
            $capitular_DE->data_casamento = $request->data_casamento_DE;
            $capitular_DE->filho = $request->filho_DE;
            $capitular_DE->endereco = $request->endereco_DE;
            $capitular_DE->email = $request->email_DE;
            $capitular_DE->data_uniao_familia = $request->data_uniao_familia_DE;
            $capitular_DE->curso = $request->curso_DE;
            $capitular_DE->ideal_curso = $request->ideal_curso_DE;
            $capitular_DE->ano_consagracao = $request->ano_consagracao_DE;
            $capitular_DE->santuario = $request->santuario_DE;
            $capitular_DE->apostolado = $request->apostolado_DE;
            $capitular_DE->desejo_casal = $request->desejo_casal_DE;
            $capitular_DE->palavra = $request->palavra_DE;
            $capitular_DE->frase = $request->frase_DE;
            $capitular_DE->expectativa = $request->expectativa_DE;
            $capitular_DE->save();


            // SALVAR NO IDIOMA ESPANHOL
            //----------------------------------

            $idioma_form_ES = IdiomaForm::where('sigla', 'ES')->first();
            $capitular_ES = new Capitular();
            $capitular_ES->capitular_agrupador_id = $capitular_agrupador->id;
            $capitular_ES->idioma_form_id = $idioma_form_ES->id;
            $capitular_ES->paise_id = $request->paise_ES;
            $capitular_ES->nome = $request->nome_ES;
            $capitular_ES->celular = $request->celular_ES;
            $capitular_ES->data_nascimento = $request->data_nascimento_ES;
            $capitular_ES->profissao = $request->profissao_ES;
            $capitular_ES->idioma = $request->idioma_ES;
            $capitular_ES->data_casamento = $request->data_casamento_ES;
            $capitular_ES->filho = $request->filho_ES;
            $capitular_ES->endereco = $request->endereco_ES;
            $capitular_ES->email = $request->email_ES;
            $capitular_ES->data_uniao_familia = $request->data_uniao_familia_ES;
            $capitular_ES->curso = $request->curso_ES;
            $capitular_ES->ideal_curso = $request->ideal_curso_ES;
            $capitular_ES->ano_consagracao = $request->ano_consagracao_ES;
            $capitular_ES->santuario = $request->santuario_ES;
            $capitular_ES->apostolado = $request->apostolado_ES;
            $capitular_ES->desejo_casal = $request->desejo_casal_ES;
            $capitular_ES->palavra = $request->palavra_ES;
            $capitular_ES->frase = $request->frase_ES;
            $capitular_ES->expectativa = $request->expectativa_ES;
            $capitular_ES->save();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ";
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('capitular.create', ['idioma' => $request->idioma])->withInput();
        } else {

            $request->session()->flash('message.token', $request->_token);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Captular foi cadastrado com sucesso');
        }

        return redirect()->route('capitular.bemvindo', ['token' => $request->_token]);
    }


    public function bemvindo(Request $request)
    {

        if($request->token && session()->has('message.token') && ($request->token === session('message.token'))){

            return view('guest.cadastro.capitular.bemvindo');

        } else{

            Auth()->logout();
            abort('403', 'Página não disponível');
        }
    }

}
