@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Gestão das Agendas (solicitações para os membros)</h4>

            <div class="page-title-right">
                @can('create_agenda_solicitacao')
                    <a href="{{route("agenda_solicitacao.create")}}" class="btn btn-outline-secondary waves-effect">Nova Agenda / Solicitação</a>
                @endcan
           </div>
        </div>
    </div>
</div>

@if(session()->has('message.level'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-{{ session('message.level') }}">
            {!! session('message.content') !!}
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Listagem das Agendas / Solicitações dos Membros</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#aberta" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Abertas ( <code class="highlighter-rouge">{{$agenda_solicitacaos->where('status', 'AB')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#agendada" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Agendadas ( <code class="highlighter-rouge">{{$agenda_solicitacaos->where('status', 'AG')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#concluida" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Concluídas ( <code class="highlighter-rouge">{{$agenda_solicitacaos->where('status', 'CL')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                    <!-- Nav tabs - ABERTA - INI -->
                    <div class="tab-pane active" id="aberta" role="tabpanel">
                        <table id="dt_aberta" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Tipo</th>
                                <th>Membro</th>
                                <th>Agendada</th>
                                <th>Realizada</th>
                                <th>Criada</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($agenda_solicitacaos->where('status', 'AB') as $agenda_solicitacao)
                            <tr>
                                <td>{{$agenda_solicitacao->data_criacao_ordenacao}}</td>
                                <td>{{$agenda_solicitacao->tipo_solicitacao->nome}}</td>
                                <td>{{$agenda_solicitacao->membro->nome}}</td>
                                <td>{{$agenda_solicitacao->data_agendamento_formatada}}</td>
                                <td>{{$agenda_solicitacao->data_realizacao_formatada}}</td>
                                <td>{{$agenda_solicitacao->data_criacao_formatada}}</td>
                                <td style="text-align:center;">

                                @can('view_agenda_solicitacao')
                                    <a href="{{route('agenda_solicitacao.show', compact('agenda_solicitacao'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Agenda/Solicitação"></i></a>
                                @endcan

                                @can('delete_agenda_solicitacao')
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$agenda_solicitacao->id}})"
                                        data-target="#modal-delete-agenda_solicitacao"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Agenda/Solicitação"></i></a>
                                        <form action="" id="deleteForm" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        @section('modal_target')"formSubmit();"@endsection
                                        @section('modal_type')@endsection
                                        @section('modal_name')"modal-delete-agenda_solicitacao"@endsection
                                        @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                        @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                        @section('modal_close')Fechar @endsection
                                        @section('modal_save')Excluir @endsection
                                @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Nenhum registro encontrado</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Nav tabs - ABERTA - FIM -->

                    <!-- Nav tabs - AGENDADA - INI -->
                    <div class="tab-pane" id="agendada" role="tabpanel">
                        <table id="dt_agendada" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Tipo</th>
                                <th>Membro</th>
                                <th>Agendada</th>
                                <th>Realizada</th>
                                <th>Criada</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($agenda_solicitacaos->where('status', 'AG') as $agenda_solicitacao)
                            <tr>
                                <td>{{$agenda_solicitacao->data_agendamento_ordenacao}}</td>
                                <td>{{$agenda_solicitacao->tipo_solicitacao->nome}}</td>
                                <td>{{$agenda_solicitacao->membro->nome}}</td>
                                <td>{{$agenda_solicitacao->data_agendamento_formatada}}</td>
                                <td>{{$agenda_solicitacao->data_realizacao_formatada}}</td>
                                <td>{{$agenda_solicitacao->data_criacao_formatada}}</td>
                                <td style="text-align:center;">

                                @can('view_agenda_solicitacao')
                                    <a href="{{route('agenda_solicitacao.show', compact('agenda_solicitacao'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Agenda/Solicitação"></i></a>
                                @endcan

                                @can('delete_agenda_solicitacao')
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$agenda_solicitacao->id}})"
                                        data-target="#modal-delete-agenda_solicitacao"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Agenda/Solicitação"></i></a>
                                        <form action="" id="deleteForm" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        @section('modal_target')"formSubmit();"@endsection
                                        @section('modal_type')@endsection
                                        @section('modal_name')"modal-delete-agenda_solicitacao"@endsection
                                        @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                        @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                        @section('modal_close')Fechar @endsection
                                        @section('modal_save')Excluir @endsection
                                @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Nenhum registro encontrado</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Nav tabs - AGENDADA - FIM -->

                    <!-- Nav tabs - CONCLUIDA - INI -->
                    <div class="tab-pane" id="concluida" role="tabpanel">
                        <table id="dt_concluida" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Tipo</th>
                                <th>Membro</th>
                                <th>Agendada</th>
                                <th>Realizada</th>
                                <th>Criada</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($agenda_solicitacaos->where('status', 'CL') as $agenda_solicitacao)
                            <tr>
                                <td>{{$agenda_solicitacao->data_realizacao_ordenacao}}</td>
                                <td>{{$agenda_solicitacao->tipo_solicitacao->nome}}</td>
                                <td>{{$agenda_solicitacao->membro->nome}}</td>
                                <td>{{$agenda_solicitacao->data_agendamento_formatada}}</td>
                                <td>{{$agenda_solicitacao->data_realizacao_formatada}}</td>
                                <td>{{$agenda_solicitacao->data_criacao_formatada}}</td>
                                <td style="text-align:center;">

                                @can('view_agenda_solicitacao')
                                    <a href="{{route('agenda_solicitacao.show', compact('agenda_solicitacao'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Agenda/Solicitação"></i></a>
                                @endcan

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Nenhum registro encontrado</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Nav tabs - AGENDADA - FIM -->

                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

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

    @if($agenda_solicitacaos->where('status', 'AB')->count() > 0)
        <script>
            var table_AB = $('#dt_aberta').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [
                    [0, "desc"]
                ],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
            });
        </script>
    @endif

    @if($agenda_solicitacaos->where('status', 'AG')->count() > 0)
        <script>
            var table_AG = $('#dt_agendada').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [
                    [0, "desc"]
                ],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
            });
        </script>
    @endif


    @if($agenda_solicitacaos->where('status', 'CL')->count() > 0)
    <script>
        var table_CL = $('#dt_concluida').DataTable({
            language: {
                url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
            },
            "order": [
                [0, "desc"]
            ],
            columnDefs: [
                {
                    targets: [ 0 ],
                    visible: false,
                },
            ],
        });
    </script>
    @endif


    <script>
       function deleteData(id)
       {
           var id = id;
           var url = '{{ route("agenda_solicitacao.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
