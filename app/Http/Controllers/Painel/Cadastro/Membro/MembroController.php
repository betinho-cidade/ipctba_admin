<?php

namespace App\Http\Controllers\Painel\Cadastro\Membro;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\LocalCongrega;
use App\Models\MeioAdmissao;
use App\Models\MeioDemissao;
use App\Models\Oficio;
use App\Models\SituacaoMembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Membro\CreateRequest;
use App\Http\Requests\Cadastro\Membro\UpdateRequest;
use Image;
use Carbon\Carbon;


class MembroController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_membro')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $membros_AT = Membro::where('status','A')
                            ->orderBy('nome', 'desc')
                            ->get();

        $membros_IN = Membro::where('status','I')
                            ->orderBy('nome', 'desc')
                            ->get();


        return view('painel.cadastro.membro.index', compact('user', 'membros_AT', 'membros_IN'));
    }



    public function create()
    {
        if(Gate::denies('create_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $local_congregas = LocalCongrega::orderBy('nome')->get();

        $meio_admissaos = MeioAdmissao::orderBy('nome')->get();

        $meio_demissaos = MeioDemissao::orderBy('nome')->get();

        $oficios = Oficio::orderBy('nome')->get();

        $situacao_membros = SituacaoMembro::orderBy('nome')->get();


        return view('painel.cadastro.membro.create', compact('user', 'local_congregas', 'meio_admissaos', 'meio_demissaos', 'oficios', 'situacao_membros'));
    }


/*
    public function store(CreateRequest $request)
    {
        if(Gate::denies('view_administrador')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if (!$roles->contains('name', 'Gestor')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $k9emails = K9Email::pluck('dominio')->toArray();
        $index_pos = strripos($request->email, '@');
        $dominio = substr($request->email, $index_pos);

        if ($request->assinatura == 'F') {
            if(in_array($dominio, $k9emails)){
                return redirect()->route('usuario.create')->withInput()->withErrors('Esse domínio de e-mail não é permitido para assinantes FAMALI.');
            }
        } elseif ($request->assinatura == 'K'){
            if(!in_array($dominio, $k9emails)){
                return redirect()->route('usuario.create')->withInput()->withErrors('Esse domínio de e-mail não é permitido para assinantes K9.');
            }
        }

        $message = '';

        try {

            DB::beginTransaction();

            $usuario = new User();

            $usuario->name = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);

            $usuario->cpf = $request->cpf;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->telefone = $request->telefone;
            $usuario->telefone_ddd = $request->telefone_ddd;
            $usuario->end_cep = $request->end_cep;
            $usuario->end_cidade = $request->end_cidade;
            $usuario->end_uf = $request->end_uf;
            $usuario->end_logradouro = $request->end_logradouro;
            $usuario->end_numero = $request->end_numero;
            $usuario->end_bairro = $request->end_bairro;
            $usuario->end_complemento = $request->end_complemento;
            $usuario->parceiro_id = $request->parceiro;

            $usuario->save();

            if($request->path_avatar){
                $img_avatar = 'avatar_'.$usuario->id.'_'.time().'.'.$request->path_avatar->extension();
                $path_avatar = 'images/avatar';

                $usuario->path_avatar = $img_avatar;

                if(!\File::isDirectory(public_path('images/avatar'))){
                    \File::makeDirectory('images/avatar');
                }

                $img = Image::make($request->path_avatar)->orientate();

                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_avatar.'/'.$img_avatar, 80);
                //$img->save($path_evidencia, 60);

                $usuario->save();
            }

            $usuario->rolesAll()->attach($request->perfil);

            $status = $usuario->rolesAll()
                              ->withPivot(['status', 'assinatura'])
                              ->first()
                              ->pivot;

            $status['status'] = $request->situacao;
            $status['assinatura'] = $request->assinatura;
            $status->save();

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
            $request->session()->flash('message.content', 'O Usuário <code class="highlighter-rouge">'. $request->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('usuario.index');
    }



    public function show(User $usuario)
    {

        if(Gate::denies('view_administrador')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if (!$roles->contains('name', 'Gestor')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $perfis = Role::all();

        $parceiros = Parceiro::All();

        return view('painel.cadastro.usuario.show', compact('user', 'usuario', 'perfis', 'parceiros'));
    }



    public function update(UpdateRequest $request, User $usuario)
    {
        if(Gate::denies('view_administrador')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if (!$roles->contains('name', 'Gestor')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $k9emails = K9Email::pluck('dominio')->toArray();
        $index_pos = strripos($request->email, '@');
        $dominio = substr($request->email, $index_pos);

        if ($usuario->assinatura_id['assinatura'] == 'F') {
            if(in_array($dominio, $k9emails)){
                return redirect()->route('usuario.show', compact('usuario'))->withInput()->withErrors('Esse domínio de e-mail não é permitido para assinantes FAMALI.');
            }
        } elseif ($usuario->assinatura_id['assinatura'] == 'K'){
            if(!in_array($dominio, $k9emails)){
                return redirect()->route('usuario.show', compact('usuario'))->withInput()->withErrors('Esse domínio de e-mail não é permitido para assinantes K9.');
            }
        }

        $message = '';

        try {

            DB::beginTransaction();

            $usuario->name = $request->nome;
            $usuario->email = $request->email;

            $usuario->cpf = $request->cpf;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->telefone = $request->telefone;
            $usuario->telefone_ddd = $request->telefone_ddd;
            $usuario->end_cep = $request->end_cep;
            $usuario->end_cidade = $request->end_cidade;
            $usuario->end_uf = $request->end_uf;
            $usuario->end_logradouro = $request->end_logradouro;
            $usuario->end_numero = $request->end_numero;
            $usuario->end_bairro = $request->end_bairro;
            $usuario->end_complemento = $request->end_complemento;
            $usuario->parceiro_id = $request->parceiro;

            if($request->password){
                $usuario->password = bcrypt($request->password);
            }

            $usuario->save();

            if($request->path_avatar){
                $img_avatar = 'avatar_'.$usuario->id.'_'.time().'.'.$request->path_avatar->extension();
                $path_avatar = 'images/avatar';

                $imageOld = $usuario->path_avatar;
                $usuario->path_avatar = $img_avatar;

                if(!\File::isDirectory(public_path('images/avatar'))){
                    \File::makeDirectory('images/avatar');
                }

                if(\File::exists(public_path($path_avatar.'/'.$imageOld))){
                    \File::delete(public_path($path_avatar.'/'.$imageOld));
                }

                $img = Image::make($request->path_avatar)->orientate();

                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_avatar.'/'.$img_avatar, 80);
                //$img->save($path_evidencia, 60);

                $usuario->save();
            }

            $assinatura_status = $usuario->assinatura_and_status;

            if($request->situacao && ($request->situacao != $assinatura_status['status']) && ($usuario->id != $user->id)){
                $assinatura_status['status'] = $request->situacao;
                $assinatura_status->save();
            }

            // if($request->assinatura && ($request->assinatura != $assinatura_status['assinatura']) && $usuario->perfil != 'Gestor'){
            //     $assinatura_status['assinatura'] = $request->assinatura;
            //     $assinatura_status->save();
            // }

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
            $request->session()->flash('message.content', 'O Usuário <code class="highlighter-rouge">'. $usuario->name .'</code> foi alterado com sucesso');
        }

        return redirect()->route('usuario.index');
    }



    public function destroy(User $usuario, Request $request)
    {
        if(Gate::denies('view_administrador')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if (!$roles->contains('name', 'Gestor')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $message = '';
        $usuario_nome = $usuario->name;

        if(($usuario->id != $user->id)) {
            try {
                DB::beginTransaction();

                DB::table('role_user')->where('user_id', '=', $usuario->id)->delete();

                $usuario->delete();

                $path_avatar = 'images/avatar';

                if(\File::exists(public_path($path_avatar.'/'.$usuario->path_avatar))){
                    \File::delete(public_path($path_avatar.'/'.$usuario->path_avatar));
                }

                DB::commit();

            } catch (Exception $ex){

                DB::rollBack();

                if(strpos($ex->getMessage(), 'sIntegrity constraint violation') !== false){
                    $message = "Não foi possível excluir o registro, pois existem referências ao mesmo em outros processos.";
                } else{
                    $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ".$ex->getMessage();
                }

            }
        } else {
            $message = "Não é possível excluir o usuário logado.";
        }


        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Usuário <code class="highlighter-rouge">'. $usuario_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('usuario.index');
    }
*/

}
