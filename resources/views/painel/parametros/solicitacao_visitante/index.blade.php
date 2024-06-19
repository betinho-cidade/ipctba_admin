@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Solicitações dos Visitantes</h4>
            
            @can('create_processo_visitante')
                <div class="page-title-right">
                    <a href="{{route("solicitacao_visitante.create")}}" class="btn btn-outline-secondary waves-effect">Nova Solicitação</a>
                </div>
            @endcan
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

                <h4 class="card-title">Listagem das Solicitações dos Visitantes do Sistema</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Solicitações ( <code class="highlighter-rouge">{{$solicitacao_visitantes->count()}}</code> )</span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA LOCAL CONGREGACAO - INI -->
                <div class="tab-pane active" id="ativa" role="tabpanel">
                    <table id="dt_solicitacao_visitantes" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Origem</th>
                            <th>Informar Motivo</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($solicitacao_visitantes as $solicitacao_visitante)
                        <tr>
                            <td>{{$solicitacao_visitante->id}}</td>
                            <td>{{$solicitacao_visitante->nome}}</td>
                            <td>{{$solicitacao_visitante->origem_texto}}</td>
                            <td>{{$solicitacao_visitante->informar_motivo_texto}}</td>
                            <td style="text-align:center;">

                            @can('edit_processo_visitante')
                                <a href="{{route('solicitacao_visitante.show', compact('solicitacao_visitante'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Solicitação"></i></a>
                            @endcan

                            @can('delete_processo_visitante')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$solicitacao_visitante->id}})"
                                    data-target="#modal-delete-solicitacao_visitante"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Solicitação"></i></a>
                                    <form action="" id="deleteForm" method="post">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-delete-solicitacao_visitante"@endsection
                                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                    @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Excluir @endsection
                            @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Nav tabs - LISTA LOCAL CONGREGACAO - FIM -->
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

    @if($solicitacao_visitantes->count() > 0)
        <script>
            var table_AT = $('#dt_solicitacao_visitantes').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 1, "asc" ]]
            });
        </script>
    @endif

    <script>
       function deleteData(id)
       {
           var id = id;
           var url = '{{ route("solicitacao_visitante.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
