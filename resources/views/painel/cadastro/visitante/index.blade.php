@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Fichas de Visitantes</h4>

            <div class="page-title-right">
                <a href="{{route("ficha_visitante.create")}}" class="btn btn-outline-secondary waves-effect" target="_blank">Nova Ficha de Visitante</a>
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

                <h4 class="card-title">Listagem das Fichas de Visitantes</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#aberta_site" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Abertas Site ( <code class="highlighter-rouge">{{$visitantes->where('status', 'AB')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#repassada_lider" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Repassada Líder ( <code class="highlighter-rouge">{{$visitantes->where('status', 'RL')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#finalizada_lider" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Finalizadas Líder ( <code class="highlighter-rouge">{{$visitantes->where('status', 'FL')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                    <!-- Nav tabs - LISTA FICHA ABERTA SITE - INI -->
                    <div class="tab-pane active" id="aberta_site" role="tabpanel">
                        <table id="dt_aberta_site" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Data Solicitação</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($visitantes->where('status', 'AB') as $visitante)
                            <tr>
                                <td>{{$visitante->data_solicitacao_ordenacao}}</td>
                                <td>{{$visitante->nome}}</td>
                                <td class="mask_celular">{{$visitante->celular}}</td>
                                <td>{{$visitante->data_solicitacao}}</td>
                                <td style="text-align:center;">

                                @can('view_ficha_visitante')
                                    <a href="{{route('visitante.show', compact('visitante'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Ficha de Atualização"></i></a>
                                @endcan

                                @can('delete_ficha_visitante')
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$visitante->id}})"
                                        data-target="#modal-delete-visitante"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Ficha de Atualização"></i></a>
                                        <form action="" id="deleteForm" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        @section('modal_target')"formSubmit();"@endsection
                                        @section('modal_type')@endsection
                                        @section('modal_name')"modal-delete-visitante"@endsection
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
                    </div>
                    <!-- Nav tabs - LISTA FICHA ABERTA SITE - FIM -->

                    <!-- Nav tabs - LISTA FICHA ABERTA LIDER - INI -->
                    <div class="tab-pane" id="repassada_lider" role="tabpanel">
                        <table id="dt_repassada_lider" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Data Solicitação</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($visitantes->where('status', 'RL') as $visitante)
                            <tr>
                                <td>{{$visitante->data_solicitacao_ordenacao}}</td>
                                <td>{{$visitante->nome}}</td>
                                <td class="mask_celular">{{$visitante->celular}}</td>
                                <td>{{$visitante->data_solicitacao}}</td>
                                <td style="text-align:center;">

                                @can('view_ficha_visitante')
                                    <a href="{{route('visitante.show', compact('visitante'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Ficha de Atualização"></i></a>
                                @endcan

                                @can('delete_ficha_visitante')
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$visitante->id}})"
                                        data-target="#modal-delete-visitante"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Ficha de Atualização"></i></a>
                                        <form action="" id="deleteForm" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        @section('modal_target')"formSubmit();"@endsection
                                        @section('modal_type')@endsection
                                        @section('modal_name')"modal-delete-visitante"@endsection
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
                    </div>
                    <!-- Nav tabs - LISTA FICHA ABERTA LIDER - FIM -->

                    <!-- Nav tabs - LISTA FICHA ABERTA CONCULIDA - INI -->
                    <div class="tab-pane" id="finalizada_lider" role="tabpanel">
                        <table id="dt_finalizada_lider" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Data Solicitação</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($visitantes->where('status', 'FL') as $visitante)
                            <tr>
                                <td>{{$visitante->data_solicitacao_ordenacao}}</td>
                                <td>{{$visitante->nome}}</td>
                                <td class="mask_celular">{{$visitante->celular}}</td>
                                <td>{{$visitante->data_solicitacao}}</td>
                                <td style="text-align:center;">

                                @can('view_ficha_visitante')
                                    <a href="{{route('visitante.show', compact('visitante'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Ficha de Atualização"></i></a>
                                @endcan

                                @can('delete_ficha_visitante')
                                    @if($visitante->status != 'C')
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$visitante->id}})"
                                        data-target="#modal-delete-visitante"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Ficha de Atualização"></i></a>
                                        <form action="" id="deleteForm" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        @section('modal_target')"formSubmit();"@endsection
                                        @section('modal_type')@endsection
                                        @section('modal_name')"modal-delete-visitante"@endsection
                                        @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                        @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                        @section('modal_close')Fechar @endsection
                                        @section('modal_save')Excluir @endsection
                                    @endif
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
                    </div>
                    <!-- Nav tabs - LISTA FICHA ABERTA CONCLUIDA - FIM -->

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
    <!-- form mask -->
    <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
		$(document).ready(function(){
            $('.mask_celular').inputmask('(99) 99999-9999');
		});
	</script>

    @if($visitantes->where('status', 'AB')->count() > 0)
        <script>
            var table_AT = $('#dt_aberta_site').DataTable({
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

    @if($visitantes->where('status', 'RL')->count() > 0)
        <script>
            var table_AT = $('#dt_repassada_lider').DataTable({
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


    @if($visitantes->where('status', 'FL')->count() > 0)
    <script>
        var table_AT = $('#dt_finalizada_lider').DataTable({
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
           var url = '{{ route("visitante.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
