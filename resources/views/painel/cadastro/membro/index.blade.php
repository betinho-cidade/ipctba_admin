@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Membros</h4>

            <div class="page-title-right">
                <a href="{{route("membro.excell")}}" class="btn btn-outline-secondary waves-effect">Exportar Excel <i class="fa fa-download color: goldenrod" title="Exportar Membros para Excell"></i></a>
                <a href="{{route("membro.create")}}" class="btn btn-outline-secondary waves-effect">Novo Membro</a>
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

                <h4 class="card-title">Listagem dos Membros</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Membros Ativos ( <code class="highlighter-rouge">{{$membros_AT->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#inativa" role="tab">
                            <span class="d-block d-sm-none"><i class=" ri-close-circle-line"></i></span>
                            <span class="d-none d-sm-block">Membros Inativos ( <code class="highlighter-rouge">{{$membros_IN->count()}}</code> )</span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA MEMBRO - ATIVA - INI -->
                <div class="tab-pane active" id="ativa" role="tabpanel">
                    <table id="dt_membros_AT" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>ROL</th>
                            <th>Nome</th>
                            <th>Situação Membro</th>
                            <th>Ofício</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($membros_AT as $membro)
                        <tr>
                            <td><img class="avatar-sm mr-3 rounded-circle" src="{{$membro->imagem}}" alt=""></td>
                            <td>{{$membro->numero_rol}}</td>
                            <td>{{$membro->nome}}</td>
                            <td>{{$membro->historico_situacao_atual}}</td>
                            <td>{{$membro->historico_oficio_atual}}</td>
                            <td style="text-align:center;">

                            @can('view_membro')
                                <a href="{{route('membro.pdf', compact('membro'))}}"><i class="fa fa-download color: goldenrod" title="Gerar PDF do Membro"></i></a>
                            @endcan

                            @can('edit_membro')
                                <a href="{{route('membro.show', compact('membro'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar o Membro"></i></a>
                            @endcan

                            @can('delete_membro')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$membro->id}})"
                                    data-target="#modal-delete-membro"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir o Membro"></i></a>
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
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Nav tabs - LISTA MEMBRO - ATIVA - FIM -->
                </div>


                <!-- Nav tabs - LISTA MEMBRO - INATIVA - INI -->
                <div class="tab-pane" id="inativa" role="tabpanel">
                    <table id="dt_membros_IN" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>ROL</th>
                            <th>Nome</th>
                            <th>Situação Membro</th>
                            <th>Ofício</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($membros_IN as $membro)
                        <tr>
                            <td><img class="avatar-sm mr-3 rounded-circle" src="{{$membro->imagem}}" alt=""></td>
                            <td>{{$membro->numero_rol}}</td>
                            <td>{{$membro->nome}}</td>
                            <td>{{$membro->historico_situacao_atual}}</td>
                            <td>{{$membro->historico_oficio_atual}}</td>
                            <td style="text-align:center;">

                            @can('view_membro')
                                <a href="{{route('membro.pdf', compact('membro'))}}"><i class="fa fa-download color: goldenrod" title="Gerar PDF do Membro"></i></a>
                            @endcan

                            @can('edit_membro')
                                <a href="{{route('membro.show', compact('membro'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar o Membro"></i></a>
                            @endcan

                            @can('delete_membro')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$membro->id}})"
                                    data-target="#modal-delete-membro"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir o Membro"></i></a>
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
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Nav tabs - LISTA MEMBRO - INATIVA - FIM -->
                </div>
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

    @if($membros_AT->count() > 0)
        <script>
            var table_AT = $('#dt_membros_AT').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 1, "desc" ]]
            });
        </script>
    @endif

    @if($membros_IN->count() > 0)
        <script>
            var table_IN = $('#dt_membros_IN').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 1, "desc" ]]
            });
        </script>
    @endif

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

@endsection
