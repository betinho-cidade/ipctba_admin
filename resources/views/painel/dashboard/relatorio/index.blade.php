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

@if(session()->has('message.level'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-{{ session('message.level') }}">
            {!! session('message.content') !!}
            </div>
        </div>
    </div>
@endif

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Relatório - Filtro de Membros do IPCTBA</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <!-- Left sidebar -->
        <div class="email-leftbar card" style="width: 240px;">

            <!-- FILTROS DE PESQUISA - INI -->
            <form name="search_membro" method="GET" action="{{route('relatorio.search')}}"  class="needs-validation" novalidate>
            @csrf
                    <h4 class="card-title">Selecione o filtro desejado</h4>
                    <div class="progress progress-sm animated-progess" style="height: 1px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p></p>

                    <!-- CAMPOS DE BUSCA - INI -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check mb-1 float-left">
                                <input class="form-check-input float-right" type="checkbox" checked id="is_ativo" name="is_ativo">
                                <label class="form-check-label float-right" for="is_ativo">
                                    Ativo
                                </label>
                            </div>
                        </div>
                        {{-- <div class="col-md-8">
                            <div class="form-check mb-1 float-right">
                                <input class="form-check-input float-right" type="checkbox" id="is_disciplina" name="is_disciplina">
                                <label class="form-check-label float-right" for="is_disciplina">
                                    Em Disciplina
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <p></p>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <select id="tipo_membro" name="tipo_membro" class="form-control">
                                <option value="">Tipo de Membro</option>
                                <option value="CM">Comungante</option>
                                <option value="NC">Não Comungante</option>
                                <option value="NM">Não Membro</option>
                                <option value="PS">Pastor</option>
                                <option value="EP">Em Processo</option>
                            </select>
                        </div>
                    </div>
                    <p></p>

                    <div class="row">
                        <div class="col-md-12">
                            <select id="status_participacao" name="status_participacao" class="form-control">
                                <option value="">Status de Participação</option>
                                @foreach($status_participacaos as $status_participacao)
                                    <option value="{{$status_participacao->id}}">{{$status_participacao->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p></p>


                    <div class="row">
                        <div class="col-md-12">
                            <select id="sexo" name="sexo" class="form-control">
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
                                        <input type="text" class="form-control" id="idade_inicial" name="idade_inicial" placeholder="Inicial">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="idade_final" name="idade_final" placeholder="Final">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="idade_inicial">Dia/Mês Aniversário</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="dia_niver_ini" name="dia_niver_ini" class="form-control">
                                            <option value="">Dia I</option>
                                            @for($i=1;$i<=31;$i++)
                                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="mes_niver_ini" name="mes_niver_ini" class="form-control">
                                            <option value="">Mês I</option>
                                            @for($i=1;$i<=12;$i++)
                                            <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div><p></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="dia_niver_fim" name="dia_niver_fim" class="form-control">
                                            <option value="">Dia F</option>
                                            @for($i=1;$i<=31;$i++)
                                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="mes_niver_fim" name="mes_niver_fim" class="form-control">
                                            <option value="">Mês F</option>
                                            @for($i=1;$i<=12;$i++)
                                            <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
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
                                        <input type="date" class="form-control" id="data_admissao_ini" name="data_admissao_ini" placeholder="Inicial">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="font-size: 20px;">F</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" id="data_admissao_fim" name="data_admissao_fim" placeholder="Final">
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
                                        <input type="date" class="form-control" id="data_demissao_ini" name="data_demissao_ini" placeholder="Inicial">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span style="font-size: 20px;">F</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" id="data_demissao_fim" name="data_demissao_fim" placeholder="Final">
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
                        @can('create_membro')
                            <a href="{{route("membro.create")}}" class="btn btn-outline-secondary waves-effect">Novo Membro</a>
                        @endcan

                        <a href="{{route("relatorio.excell", compact('excel_params'))}}" class="btn btn-outline-secondary waves-effect">Exportar Excel <i class="fa fa-download color: goldenrod" title="Exportar Membros para Excell"></i></a>
                    </span>

                    <div class="tab-content py-4">
                        <div class="tab-pane show active" id="pendente">
                            <div>
                                <h5 class="px-3 mb-3" style="text-align: center">&nbsp; Listagem de Membros Pesquisado &nbsp;</h1>
                                @php $count = 0; @endphp
                                <span>
                                @if($excel_params)
                                    @foreach ($excel_params as $param=>$value )
                                        @if($value)
                                            @if($count == 0)
                                                <code style="font-size:14px;">Filtro:</code>
                                            @endif
                                            <code style="font-size:14px;">[{{ $excel_params_translate[$param] }}: {{ ($param=='status_participacao') ? $status_descricao->nome : $value }}]&nbsp;</code>
                                            @php $count = $count + 1; @endphp
                                        @endif
                                    @endforeach
                                    </code>
                                @endif
                                </sapn>

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" title="Lista de Membros">
                                        <a class="nav-link active" data-toggle="tab" href="#lista_membros" role="tab">
                                            <span class="d-sm-block">Membros ( <code class="highlighter-rouge">{{($membros) ? $membros->count() : 0}}</code> )</span>
                                        </a>
                                    </li>

                                    @if($membros)
                                        <span class="float-right" style="font-size: 12px;">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Registros: {{ ($membros->lastItem()) ? $membros->lastItem() : 0}} / {{ $membros->total() }} &nbsp;&nbsp;&nbsp;
                                            Página: {{ $membros->currentPage() }} / {{ $membros->lastPage() }} &nbsp;&nbsp;&nbsp;
                                            @if($membros->previousPageUrl()) <a href="{{ $membros->previousPageUrl() . '&' . http_build_query($excel_params)}}"> <i class="mdi mdi-skip-previous" style="font-size: 16px;" title="Anterior"></i>  </a> @else <i class="mdi mdi-dots-horizontal" style="font-size: 16px;" title="..."></i> @endif
                                            @if($membros->hasMorePages()) <a href="{{ $membros->nextPageUrl() . '&' . http_build_query($excel_params)}}"> <i class="mdi mdi-skip-next" style="font-size: 16px;" title="Próximo"></i>  </a> @else <i class="mdi mdi-dots-horizontal" style="font-size: 16px;" title="..."></i> @endif
                                        </span>
                                        <br>
                                    @endif
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">

                                    <!-- Lista Membros - INI -->
                                    <div class="tab-pane active" id="lista_membros" role="tabpanel">
                                        <ul class="list-unstyled chat-list" data-simplebar>
                                            <table id="dt_lista_membros" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    {{-- <th>Avatar</th> --}}
                                                    <th>Nome</th>
                                                    <th>ROL</th>
                                                    <th>Ações</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if($membros)
                                                    @forelse($membros as $membro)
                                                    <tr>
                                                        {{-- <td><img class="avatar-sm mr-3 rounded-circle" src="{{$membro->imagem}}" alt=""></td> --}}
                                                        <td>{{$membro->nome}}</td>
                                                        <td>{{$membro->numero_rol}}</td>
                                                        <td style="text-align:center;">

                                                            @can('view_membro')
                                                                <a href="{{route('membro.pdf', compact('membro'))}}"><i class="fa fa-download color: goldenrod" title="Gerar PDF do Membro"></i></a>
                                                            @endcan

                                                            @can('view_membro')
                                                                <a href="{{route('membro.show', compact('membro'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Visualizar Membro"></i></a>
                                                            @endcan

                                                            @can('delete_membro')
                                                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$membro->id}})"
                                                                    data-target="#modal-delete-membro"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir o Membro"></i>
                                                                </a>
                                                            @endcan
                                                            </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="3">Nenhum registro encontrado</td>
                                                    </tr>
                                                    @endforelse
                                                @else
                                                    <td colspan="3">Utilize o filtro ao lado para realizar a busca.</td>
                                                @endif
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

    @can('delete_membro')
       <form action="" id="deleteForm" method="post">
        @csrf
        @method('DELETE')
        </form>

        @section('modal_target')"formSubmit();"@endsection
        @section('modal_type')@endsection
        @section('modal_name')"modal-delete-membro"@endsection
        @section('modal_msg_title')Deseja excluir o registro ? @endsection
        @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
        @section('modal_close')Fechar @endsection
        @section('modal_save')Excluir @endsection
    @endcan

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

    @if($membros && $membros->count() > 0)
    <script>
        var table_IN = $('#dt_lista_membros').DataTable({
            language: {
                url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
            },
            "order": [[ 0, "asc" ]]
        });
    </script>
    @endif

    @can('delete_membro')
        <script>
            function deleteData(id)
            {
                var id = id;
                var url = '{{ route("membro.destroy", ":id") }}';
                url = url.replace(':id', id);
                $("#deleteForm").attr('action', url);
            }

            function formSubmit()
            {
                $("#deleteForm").submit();
            }
        </script>
    @endcan

@endsection


