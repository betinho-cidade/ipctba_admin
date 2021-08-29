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
use App\Models\TIpoSolicitacao;
use App\Models\Ministerio;
use App\Models\MembroMinisterio;
use App\Models\HistoricoOficio;
use App\Models\HistoricoSituacao;
use App\Models\HistoricoSolicitacao;
use App\Models\MembroFamilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Membro\CreateRequest;
use App\Http\Requests\Cadastro\Membro\UpdateRequest;
use App\Exports\MembrosExport;
use Image;
use Carbon\Carbon;
use Excel;
use PDF;


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

        $ministerios = Ministerio::orderBy('nome')->get();

        $perfis = Role::where('name', 'Membro')
                        ->get();


        return view('painel.cadastro.membro.create', compact('user', 'local_congregas', 'meio_admissaos', 'meio_demissaos', 'oficios', 'situacao_membros', 'ministerios', 'perfis'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $membro = new Membro();

            $membro->local_congrega_id = ($request->local_congrega) ? $request->local_congrega : null;
            $membro->meio_admissao_id = ($request->meio_admissao) ? $request->meio_admissao : null;
            $membro->meio_demissao_id = ($request->meio_demissao) ? $request->meio_demissao : null;
            $membro->is_pastor = ($request->is_pastor) ? 'S' : 'N';
            $membro->is_disciplina = ($request->is_disciplina) ? 'S' : 'N';
            $membro->nome = $request->nome;
            $membro->email = $request->email_membro;
            $membro->cpf = $request->cpf;
            $membro->sexo = $request->sexo;
            $membro->celular = $request->celular;
            $membro->data_nascimento = $request->data_nascimento;
            $membro->naturalidade = $request->naturalidade;
            $membro->status = $request->situacao_membro;
            $membro->conjuge = $request->conjuge;
            $membro->data_casamento = $request->data_casamento;
            $membro->profissao = $request->profissao;
            $membro->nome_pai = $request->nome_pai;
            $membro->nome_mae = $request->nome_mae;
            $membro->end_cep = $request->end_cep;
            $membro->end_cidade = $request->end_cidade;
            $membro->end_uf = $request->end_uf;
            $membro->end_logradouro = $request->end_logradouro;
            $membro->end_numero = $request->end_numero;
            $membro->end_bairro = $request->end_bairro;
            $membro->end_complemento = $request->end_complemento;
            $membro->estado_civil = $request->estado_civil;
            $membro->escolaridade = $request->escolaridade;
            $membro->numero_rol = $request->numero_rol;
            $membro->tipo_membro = $request->tipo_membro;
            $membro->data_batismo = $request->data_batismo;
            $membro->pastor_batismo = $request->pastor_batismo;
            $membro->igreja_batismo = $request->igreja_batismo;
            $membro->data_profissao_fe = $request->data_profissao_fe;
            $membro->pastor_profissao_fe = $request->pastor_profissao_fe;
            $membro->igreja_profissao_fe = $request->igreja_profissao_fe;
            $membro->numero_ata = $request->numero_ata;
            $membro->data_admissao = $request->data_admissao;
            $membro->data_demissao = $request->data_demissao;
            $membro->aptidao = $request->aptidao;

            $membro->save();

            if($request->ministerio){
                foreach($request->ministerio as $key => $value){
                    $membro_ministerio = new MembroMinisterio();
                    $membro_ministerio->membro_id = $membro->id;
                    $membro_ministerio->ministerio_id = $value;
                    $membro_ministerio->save();
                }
            }

            if($request->path_imagem){
                $img_avatar = 'avatar_'.$membro->id.'_'.time().'.'.$request->path_imagem->extension();
                $path_avatar = 'images/avatar';

                $membro->path_imagem = $img_avatar;

                if(!\File::isDirectory(public_path('images/avatar'))){
                    \File::makeDirectory('images/avatar');
                }

                $img = Image::make($request->path_imagem)->orientate();

                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_avatar.'/'.$img_avatar, 80);
                //$img->save($path_evidencia, 60);

                $membro->save();
            }

            if($request->situacao && $request->perfil && $request->email && $request->password) {

                $user = new User();

                $user->name = $request->nome;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

                $membro->user_id = $user->id;
                $membro->save();

                $user->rolesAll()->attach($request->perfil);

                $status = $user->rolesAll()
                               ->withPivot(['status'])
                               ->first()
                               ->pivot;

                $status['status'] = $request->situacao;
                $status->save();
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
            $request->session()->flash('message.content', 'O Membro <code class="highlighter-rouge">'. $request->nome .'</code> foi criado com sucesso');
        }

        return redirect()->route('membro.index');
    }



    public function show(Membro $membro)
    {

        if(Gate::denies('edit_membro')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $local_congregas = LocalCongrega::orderBy('nome')->get();

        $meio_admissaos = MeioAdmissao::orderBy('nome')->get();

        $meio_demissaos = MeioDemissao::orderBy('nome')->get();

        $oficios = Oficio::orderBy('nome')->get();

        $situacao_membros = SituacaoMembro::orderBy('nome')->get();

        $ministerios = Ministerio::orderBy('nome')->get();

        $perfis = Role::where('name', 'Membro')
                        ->get();

        $historico_oficios = HistoricoOficio::where('membro_id', $membro->id)
                                              ->orderBy('data_fim', 'desc')
                                              ->get();

        $historico_situacaos = HistoricoSituacao::where('membro_id', $membro->id)
                                              ->orderBy('data_fim', 'desc')
                                              ->get();

        $historico_solicitacaos = HistoricoSolicitacao::where('membro_id', $membro->id)
                                              ->orderBy('data_realizacao', 'desc')
                                              ->get();

        $membro_familias = MembroFamilia::where('membro_id', $membro->id)
                                          ->get();

        return view('painel.cadastro.membro.show', compact('user', 'membro', 'local_congregas', 'meio_admissaos', 'meio_demissaos', 'oficios', 'situacao_membros', 'ministerios', 'perfis', 'historico_oficios', 'historico_situacaos', 'historico_solicitacaos', 'membro_familias'));
    }



    public function update(UpdateRequest $request, Membro $membro)
    {
        if(Gate::denies('edit_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $membro->local_congrega_id = $request->local_congrega;
            $membro->meio_admissao_id = $request->meio_admissao;
            $membro->meio_demissao_id = $request->meio_demissao;
            $membro->is_pastor = ($request->is_pastor) ? 'S' : 'N';
            $membro->is_disciplina = ($request->is_disciplina) ? 'S' : 'N';
            $membro->nome = $request->nome;
            $membro->email = $request->email_membro;
            $membro->cpf = $request->cpf;
            $membro->sexo = $request->sexo;
            $membro->celular = $request->celular;
            $membro->data_nascimento = $request->data_nascimento;
            $membro->naturalidade = $request->naturalidade;
            $membro->status = $request->situacao_membro;
            $membro->conjuge = $request->conjuge;
            $membro->data_casamento = $request->data_casamento;
            $membro->profissao = $request->profissao;
            $membro->nome_pai = $request->nome_pai;
            $membro->nome_mae = $request->nome_mae;
            $membro->end_cep = $request->end_cep;
            $membro->end_cidade = $request->end_cidade;
            $membro->end_uf = $request->end_uf;
            $membro->end_logradouro = $request->end_logradouro;
            $membro->end_numero = $request->end_numero;
            $membro->end_bairro = $request->end_bairro;
            $membro->end_complemento = $request->end_complemento;
            $membro->estado_civil = $request->estado_civil;
            $membro->escolaridade = $request->escolaridade;
            $membro->numero_rol = $request->numero_rol;
            $membro->tipo_membro = $request->tipo_membro;
            $membro->data_batismo = $request->data_batismo;
            $membro->pastor_batismo = $request->pastor_batismo;
            $membro->igreja_batismo = $request->igreja_batismo;
            $membro->data_profissao_fe = $request->data_profissao_fe;
            $membro->pastor_profissao_fe = $request->pastor_profissao_fe;
            $membro->igreja_profissao_fe = $request->igreja_profissao_fe;
            $membro->numero_ata = $request->numero_ata;
            $membro->data_admissao = $request->data_admissao;
            $membro->data_demissao = $request->data_demissao;
            $membro->aptidao = $request->aptidao;

            $membro->save();

            $membro->membro_ministerios()->delete();

            if($request->ministerio){
                foreach($request->ministerio as $key => $value){
                    $membro_ministerio = new MembroMinisterio();
                    $membro_ministerio->membro_id = $membro->id;
                    $membro_ministerio->ministerio_id = $value;
                    $membro_ministerio->save();
                }
            }

            if($request->path_imagem){
                $img_avatar = 'avatar_'.$membro->id.'_'.time().'.'.$request->path_imagem->extension();
                $path_imagem = 'images/avatar';

                $imageOld = $membro->path_imagem;
                $membro->path_imagem = $img_avatar;

                if(!\File::isDirectory(public_path($path_imagem))){
                    \File::makeDirectory($path_imagem);
                }

                if(\File::exists(public_path($path_imagem.'/'.$imageOld))){
                    \File::delete(public_path($path_imagem.'/'.$imageOld));
                }

                $img = Image::make($request->path_imagem)->orientate();

                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_imagem.'/'.$img_avatar, 80);
                //$img->save($path_evidencia, 60);

                $membro->save();
            }

            if(!$membro->user && $request->situacao && $request->perfil && $request->email && $request->password) {

                $user = new User();

                $user->name = $request->nome;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

                $membro->user_id = $user->id;
                $membro->save();

                $user->rolesAll()->attach($request->perfil);

                $status = $user->rolesAll()
                               ->withPivot(['status'])
                               ->first()
                               ->pivot;

                $status['status'] = $request->situacao;
                $status->save();

            } else if($membro->user) {

                $membro->user->name = $request->nome;
                $membro->user->email = $request->email;

                $status = $membro->user->rolesAll()
                            ->withPivot(['status'])
                            ->first()
                            ->pivot;

                $status['status'] = $request->situacao;
                $status->save();

                if($request->password){
                    $membro->user->password = bcrypt($request->password);
                }

                $membro->user->save();
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

        return redirect()->route('membro.index');
    }



    public function destroy(Membro $membro, Request $request)
    {
        if(Gate::denies('delete_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $membro_nome = $membro->nome;

        try {
            DB::beginTransaction();

            $usuario = User::find($membro->user_id);

            $membro->delete();

            if($usuario){
                DB::table('role_user')->where('user_id', '=', $usuario->id)->delete();

                DB::table('membro_ministerios')->where('membro_id', '=', $membro->id)->delete();

                $usuario->delete();
            }


            $path_imagem = 'images/avatar';

            if(\File::exists(public_path($path_imagem.'/'.$membro->path_imagem))){
                \File::delete(public_path($path_imagem.'/'.$membro->path_imagem));
            }

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
            $request->session()->flash('message.content', 'O Membro <code class="highlighter-rouge">'. $membro_nome .'</code> foi excluído com sucesso');
        }

        return redirect()->route('membro.index');
    }


    public function pdf(Membro $membro)
    {
        if(Gate::denies('view_membro')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $download = '';
        $dompdf = PDF::loadView('painel.cadastro.membro.report', compact('user', 'membro'));
        //$dompdf->setPaper('city', 'landscape');

        // download PDF file with download method
        return $dompdf->download('Membro.pdf');
    }

    public function excell()
    {
        if(Gate::denies('view_membro')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return Excel::download(new MembrosExport, 'membros.xlsx');
    }


}
