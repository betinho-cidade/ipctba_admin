@extends('painel.layout.index')


@section('content')

@if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        </div>
    </div>
@endif

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Relatório - FIltro de Membros do IPCTBA</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <!-- Left sidebar -->
        <div class="email-leftbar card" style="width: 240px;">

            <!-- FILTROS DE PESQUISA - INI -->
            <form name="search_membro" method="POST" action="{{route('relatorio.search')}}"  class="needs-validation" novalidate>
            @csrf
                    <h4 class="card-title">Selecione o filtro desejado</h4>
                    <div class="progress progress-sm animated-progess" style="height: 1px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <p></p>

                    <!-- CAMPOS DE BUSCA - INI -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check mb-1 float-right">
                                <input class="form-check-input float-right" type="checkbox" id="is_disciplina" name="is_disciplina">
                                <label class="form-check-label float-right" for="is_disciplina">
                                    Em Disciplina
                                </label>
                            </div>
                        </div>
                    </div>
                    <p></p>

                    <div class="row">
                        <div class="col-md-12">
                            <select id="tipo_membro" name="tipo_membro" class="form-control" required>
                                <option value="">Tipo de Membro</option>
                                <option value="CM">Comungante</option>
                                <option value="NC">Não Comungante</option>
                                <option value="NM">Não Membro</option>
                                <option value="PS">Pastor</option>
                            </select>
                        </div>
                    </div>
                    <p></p>

                    <div class="row">
                        <div class="col-md-12">
                            <select id="sexo" name="sexo" class="form-control" required>
                                <option value="">Sexo</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <p></p>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="idade_inicial">Faixa Etária</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="idade_inicial" name="idade_inicial" placeholder="Inicial" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="idade_final" name="idade_final" placeholder="FInal" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="data_admissao">Data Admissão</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="font-size: 20px;">I</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" id="data_admissao_ini" name="data_admissao_ini" placeholder="Inicial" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="font-size: 20px;">F</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" id="data_admissao_fim" name="data_admissao_fim" placeholder="FInal" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="data_admissao">Data Demissão</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="font-size: 20px;">I</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" id="data_demissao_ini" name="data_demissao_ini" placeholder="Inicial" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="font-size: 20px;">F</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" id="data_demissao_fim" name="data_demissao_fim" placeholder="FInal" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p></p>

                    <!-- CAMPOS DE BUSCA - FIM -->

                    <div class="progress progress-sm animated-progess" style="height: 1px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Filtrar</button>
                    </div>

            </form>
            <!-- FILTROS DE PESQUISA - FIM -->


        </div>
        <!-- End Left sidebar -->

        <!-- Right Sidebar -->
        <div class="email-rightbar mb-3">
            <div class="card">
                <div class="card-body">

                    <span class="float-right">
                        <a href="{{route("relatorio.excell", compact('excel_params'))}}" class="btn btn-outline-secondary waves-effect">Exportar Excel <i class="fa fa-download color: goldenrod" title="Exportar Membros para Excell"></i></a>
                    </span>

                    <div class="tab-content py-4">
                        <div class="tab-pane show active" id="pendente">
                            <div>
                                <h5 class="px-3 mb-3" style="text-align: center">&nbsp; Listagem de Membros Pesquisado &nbsp;</h1>
                                @php $count = 0; @endphp
                                <span style="font-size:12px;">
                                @if($excel_params)
                                    @foreach ($excel_params as $param=>$value )
                                        @if($value)
                                            @if($count == 0)
                                                <code>Filtro:</code>
                                            @endif
                                            <code>[{{ $param }}:{{ $value }}]&nbsp;</code>
                                            @php $count = $count + 1; @endphp
                                        @endif
                                    @endforeach
                                    </code>
                                @endif
                                </sapn>

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" title="Lista de Membros">
                                        <a class="nav-link active" data-toggle="tab" href="#lista_membros" role="tab">
                                            <span class="d-sm-block">Membros ( <code class="highlighter-rouge">{{$membros->count()}}</code> )</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">

                                    <!-- Lista Membros - INI -->
                                    <div class="tab-pane active" id="lista_membros" role="tabpanel">
                                        <ul class="list-unstyled chat-list" data-simplebar>
                                            <table id="dt_lista_membros" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Avatar</th>
                                                    <th>ROL</th>
                                                    <th>Nome</th>
                                                    <th>Situação Membro</th>
                                                    <th>Ofício</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @forelse($membros as $membro)
                                                <tr>
                                                    <td>
                                                        @if(Gate::check('view_membro'))
                                                            <a href="{{route('membro.show', compact('membro'))}}"><img class="avatar-sm mr-3 rounded-circle" src="{{$membro->imagem}}" alt=""></a>
                                                        @else
                                                            <img class="avatar-sm mr-3 rounded-circle" src="{{$membro->imagem}}" alt="">
                                                        @endif
                                                    </td>
                                                    <td>{{$membro->numero_rol}}</td>
                                                    <td>{{$membro->nome}}</td>
                                                    <td>{{$membro->historico_situacao_atual}}</td>
                                                    <td>{{$membro->historico_oficio_atual}}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5">Nenhum registro encontrado</td>
                                                </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </ul>
                                    </div>
                                    <!-- Lista Membros - FIM -->
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- card -->

    </div>
    <!-- end Col-9 -->

</div>
<!-- end row -->

@endsection


@section('script-js')

    <!-- Required datatable js -->
    <script src="{{asset('nazox/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('nazox/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset('nazox/assets/js/pages/datatables.init.js')}}"></script>

    @if($membros->count() > 0)
    <script>
        var table_IN = $('#dt_lista_membros').DataTable({
            language: {
                url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
            },
            "order": [[ 0, "asc" ]]
        });
    </script>
    @endif

@endsection


