<?php

namespace App\Http\Controllers\Guest\Cadastro\NovoMembro;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\MembroFilho;
use App\Models\SituacaoMembro;
use App\Models\StatusParticipacao;
use App\Models\HistoricoSituacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\NovoMembro\CreateRequest;
use Image;
use Carbon\Carbon;


class NovoMembroController extends Controller
{

    public function create()
    {
        return view('guest.cadastro.novo_membro.create');
    }



    public function store(CreateRequest $request)
    {

        $message = '';

        try {

            DB::beginTransaction();

            $membro = new Membro();

            $membro->nome = $request->nome;
            $membro->email = $request->email_membro;
            $membro->sexo = $request->sexo;
            $membro->celular = $request->celular;
            $membro->data_nascimento = $request->data_nascimento;
            $membro->naturalidade = $request->naturalidade;
            $membro->status = 'I';
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
            $membro->tipo_membro = 'EP';
            $membro->data_batismo = $request->data_batismo;
            $membro->pastor_batismo = $request->pastor_batismo;
            $membro->igreja_batismo = $request->igreja_batismo;
            $membro->data_profissao_fe = $request->data_profissao_fe;
            $membro->pastor_profissao_fe = $request->pastor_profissao_fe;
            $membro->igreja_profissao_fe = $request->igreja_profissao_fe;
            $membro->igreja_old_nome = $request->igreja_old_nome;
            $membro->igreja_old_cidade = $request->igreja_old_cidade;
            $membro->igreja_old_pastor = $request->igreja_old_pastor;
            $membro->igreja_old_pastor_email = $request->igreja_old_pastor_email;
            $membro->aptidao = $request->aptidao;
            $membro->is_disciplina = 'N';

            $membro->save();

            $count = 0;
            $filhos_nome = $request->filho_nome;
            $filhos_data_nascimento = $request->filho_data_nascimento;
            $filhos_sexo = $request->filho_sexo;

            if($filhos_nome){
                foreach($filhos_nome as $filho) {

                    $newMembroFilho = new MembroFilho();

                    $newMembroFilho->membro_id = $membro->id;
                    $newMembroFilho->nome = $filho;
                    $newMembroFilho->data_nascimento = $filhos_data_nascimento[$count];
                    $newMembroFilho->sexo = $filhos_sexo[$count];

                    $newMembroFilho->save();
                    $count = $count + 1;
                }
            }

            $situacao_membro_1 = SituacaoMembro::where('nome', 'Tempo de Igreja')->first();

            $situacao_membro_2 = SituacaoMembro::where('nome', 'Cadastro Site')->first();

            if($situacao_membro_1) {
                $historico_situacao = new HistoricoSituacao();

                $historico_situacao->membro_id = $membro->id;
                $historico_situacao->situacao_membro_id = $situacao_membro_1->id;
                $historico_situacao->data_inicio = Carbon::now();
                $historico_situacao->data_fim = $historico_situacao->data_inicio;
                $historico_situacao->comentario = $request->tempo_igreja;;

                $historico_situacao->save();
            }

            if($situacao_membro_2) {
                $historico_situacao = new HistoricoSituacao();

                $historico_situacao->membro_id = $membro->id;
                $historico_situacao->situacao_membro_id = $situacao_membro_2->id;
                $historico_situacao->data_inicio = Carbon::now();
                $historico_situacao->comentario = 'Cadastro realizado pelo Site';

                $historico_situacao->save();
            }

            $status_participacao_membro = StatusParticipacao::where('nome', '2_Formulário')->first();

            if($status_participacao_membro) {
                $membro->status_participacao_id = $status_participacao_membro->id;
                $membro->save();
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
            $request->session()->flash('message.content', 'A solicitação de cadastro foi criada com sucesso');
        }


        return redirect()->route('novo_membro.bemvindo', ['token' => $request->_token]);

    }


    public function bemvindo(Request $request)
    {

        if($request->token && session()->has('message.token') && ($request->token === session('message.token'))){

            return view('guest.cadastro.novo_membro.bemvindo');

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
