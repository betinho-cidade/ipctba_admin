<?php

namespace App\Http\Controllers\Painel\Dashboard\Relatorio;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\Relatorio\SearchRequest;
use App\Exports\MembrosExport;
use Image;
use Carbon\Carbon;
use Excel;



class RelatorioController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_relatorio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $membros = null;;

        $excel_params = [];

        return view('painel.dashboard.relatorio.index', compact('user', 'membros', 'excel_params'));
    }




    public function search(SearchRequest $request)
    {
        if(Gate::denies('view_relatorio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        if($request->excel_params) {
            $excel_params = [
                'is_disciplina' => isset($request->excel_params['is_disciplina']) ? $request->excel_params['is_disciplina'] : '',
                'is_ativo' => isset($request->excel_params['is_ativo']) ? $request->excel_params['is_ativo'] : '',
                'nome' => isset($request->excel_params['nome']) ? $request->excel_params['nome'] : '',
                'tipo_membro' => isset($request->excel_params['tipo_membro']) ? $request->excel_params['tipo_membro'] : '',
                'sexo' => isset($request->excel_params['sexo']) ? $request->excel_params['sexo'] : '',
                'idade_inicial' => isset($request->excel_params['idade_inicial']) ? $request->excel_params['idade_inicial'] : '',
                'idade_final' => isset($request->excel_params['idade_final']) ? $request->excel_params['idade_final'] : '',
                'dia_niver_ini' => isset($request->excel_params['dia_niver_ini']) ? $request->excel_params['dia_niver_ini'] : '',
                'dia_niver_fim' => isset($request->excel_params['dia_niver_fim']) ? $request->excel_params['dia_niver_fim'] : '',
                'mes_niver_ini' => isset($request->excel_params['mes_niver_ini']) ? $request->excel_params['mes_niver_ini'] : '',
                'mes_niver_fim' => isset($request->excel_params['mes_niver_fim']) ? $request->excel_params['mes_niver_fim'] : '',
                'data_admissao_ini' => isset($request->excel_params['data_admissao_ini']) ? $request->excel_params['data_admissao_ini'] : '',
                'data_admissao_fim' => isset($request->excel_params['data_admissao_fim']) ? $request->excel_params['data_admissao_fim'] : '',
                'data_demissao_ini' => isset($request->excel_params['data_demissao_ini']) ? $request->excel_params['data_demissao_ini'] : '',
                'data_demissao_fim' => isset($request->excel_params['data_demissao_fim']) ? $request->excel_params['data_demissao_fim'] : '',
            ];
        } else {
            $excel_params = [
                'is_disciplina' => isset($request->is_disciplina) ? $request->is_disciplina : '',
                'is_ativo' => isset($request->is_ativo) ? $request->is_ativo : '',
                'nome' => isset($request->nome) ? $request->nome : '',
                'tipo_membro' => isset($request->tipo_membro) ? $request->tipo_membro : '',
                'sexo' => isset($request->sexo) ? $request->sexo : '',
                'idade_inicial' => isset($request->idade_inicial) ? $request->idade_inicial : '',
                'idade_final' => isset($request->idade_final) ? $request->idade_final : '',
                'dia_niver_ini' => isset($request->dia_niver_ini) ? $request->dia_niver_ini : '',
                'dia_niver_fim' => isset($request->dia_niver_fim) ? $request->dia_niver_fim : '',
                'mes_niver_ini' => isset($request->mes_niver_ini) ? $request->mes_niver_ini : '',
                'mes_niver_fim' => isset($request->mes_niver_fim) ? $request->mes_niver_fim : '',
                'data_admissao_ini' => isset($request->data_admissao_ini) ? $request->data_admissao_ini : '',
                'data_admissao_fim' => isset($request->data_admissao_fim) ? $request->data_admissao_fim : '',
                'data_demissao_ini' => isset($request->data_demissao_ini) ? $request->data_demissao_ini : '',
                'data_demissao_fim' => isset($request->data_demissao_fim) ? $request->data_demissao_fim : '',
            ];
        }


        $membros = Membro::where(function($query) use ($excel_params){
                        if ($excel_params['is_ativo']) {
                            $query->where('status', 'A');
                        } else {
                            $query->where('status', 'I');
                        }
                        if ($excel_params['is_disciplina']) {
                            $query->where('is_disciplina', 'S');
                        }
                        if ($excel_params['nome']) {
                            $query->where('nome', 'like', $excel_params['nome']);
                        }
                        if ($excel_params['tipo_membro']) {
                            $query->where('tipo_membro', $excel_params['tipo_membro']);
                        }
                        if ($excel_params['sexo']) {
                            $query->where('sexo', $excel_params['sexo']);
                        }
                        if($excel_params['idade_inicial'] && $excel_params['idade_final']){
                            $minDate = Carbon::today()->subYears($excel_params['idade_final']);
                            $maxDate = Carbon::today()->subYears($excel_params['idade_inicial'])->endOfDay();
                            $query->whereBetween('data_nascimento', [$minDate, $maxDate]);
                        }
                        if($excel_params['dia_niver_ini'] && $excel_params['dia_niver_fim'] && $excel_params['mes_niver_ini'] && $excel_params['mes_niver_fim']){
                            $minDate = $excel_params['mes_niver_ini'] . $excel_params['dia_niver_ini'];
                            $maxDate = $excel_params['mes_niver_fim'] . $excel_params['dia_niver_fim'];
                            $query->whereRaw("DATE_FORMAT(data_nascimento, '%m%d') BETWEEN ? AND ?", [$minDate, $maxDate]);
                        }
                        if($excel_params['data_admissao_ini'] && $excel_params['data_admissao_fim']){
                            $minDate = $excel_params['data_admissao_ini'];
                            $maxDate = $excel_params['data_admissao_fim'];
                            $query->whereBetween('data_admissao', [$minDate, $maxDate]);
                        }
                        if($excel_params['data_demissao_ini'] && $excel_params['data_demissao_fim']){
                            $minDate = $excel_params['data_demissao_ini'];
                            $maxDate = $excel_params['data_demissao_fim'];
                            $query->whereBetween('data_demissao', [$minDate, $maxDate]);
                        }

                    })
                    ->orderBy('nome', 'asc')
                    ->paginate(300);
                    //->get();

        return view('painel.dashboard.relatorio.index', compact('user', 'membros', 'excel_params'));
    }

    public function excell(Request $request)
    {
        if(Gate::denies('view_relatorio')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        return Excel::download(new MembrosExport($request->excel_params), 'membros.xlsx');
    }


}

