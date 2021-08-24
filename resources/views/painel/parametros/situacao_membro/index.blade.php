@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Situações dos Membros</h4>

            <div class="page-title-right">
                <a href="{{route("situacao_membro.create")}}" class="btn btn-outline-secondary waves-effect">Nova Situação do Membro</a>
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

                <h4 class="card-title">Listagem das Situações dos Membros do Sistema</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Situações dos Membros ( <code class="highlighter-rouge">{{$situacao_membros->count()}}</code> )</span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA LOCAL CONGREGACAO - INI -->
                <div class="tab-pane active" id="ativa" role="tabpanel">
                    <table id="dt_situacao_membros" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($situacao_membros as $situacao_membro)
                        <tr>
                            <td>{{$situacao_membro->id}}</td>
                            <td>{{$situacao_membro->nome}}</td>
                            <td style="text-align:center;">

                            @can('edit_situacao_membro')
                                <a href="{{route('situacao_membro.show', compact('situacao_membro'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Situação do Membro"></i></a>
                            @endcan

                            @can('delete_situacao_membro')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$situacao_membro->id}})"
                                    data-target="#modal-delete-situacao_membro"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Situação do Membro"></i></a>
                                    <form action="" id="deleteForm" method="post">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-delete-situacao_membro"@endsection
                                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                    @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Excluir @endsection
                            @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">Nenhum registro encontrado</td>
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

    @if($situacao_membros->count() > 0)
        <script>
            var table_AT = $('#dt_situacao_membros').DataTable({
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
           var url = '{{ route("situacao_membro.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
