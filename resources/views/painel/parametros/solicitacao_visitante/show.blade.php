@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações da Solicitação</h4>
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 class="card-title">Formulário de Atualização - Solicitação</h4>
            <p class="card-title-desc">A Solicitação cadastrada será utilizada no preenchimento da Ficha do Visitante.</p>

            <form name="edit_solicitacao_visitante" method="POST" action="{{route('solicitacao_visitante.update', compact('solicitacao_visitante'))}}"  class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados da Solicitação</h5>
                </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{$solicitacao_visitante->nome}}" placeholder="Solicitação" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="origem">Origem</label>
                                <select id="origem" name="origem" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="GR" {{($solicitacao_visitante->origem == 'GR') ? 'selected' : '' }}>Geral</option>
                                    <option value="ES" {{($solicitacao_visitante->origem == 'ES') ? 'selected' : '' }}>Específica</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="informar_motivo">Informar Motivo</label>
                                <select id="informar_motivo" name="informar_motivo" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="S" {{($solicitacao_visitante->informar_motivo == 'S') ? 'selected' : '' }}>Sim</option>
                                    <option value="N" {{($solicitacao_visitante->informar_motivo == 'N') ? 'selected' : '' }}>Não</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>                        
                    </div>

                <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
            </form>

            <div class="bg-soft-primary p-3 rounded" style="margin-top:30px;margin-bottom:10px;">
                <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Processos vinculados à solicitação do visitante</h5>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#processos" role="tab">
                                <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                                <span class="d-none d-sm-block">
                                    <i onClick="location.href='{{route('processo_visitante.create', compact('solicitacao_visitante'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Processo para a Solicitação"></i>
                                    Processos ( <code class="highlighter-rouge">{{ $solicitacao_visitante->processo_visitantes->count() }}</code> )
                                </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Nav tabs - USUARIOS - FIM -->      
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="processos" role="tabpanel">
                            <table id="dt_processo_visitantes" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th style="text-align:center;">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($solicitacao_visitante->processo_visitantes as $processo_visitante)
                                        <tr>
                                            <td>{{ $processo_visitante->id }}</td>
                                            <td>{{ $processo_visitante->nome }}</td>
                                            <td style="text-align:center;">

                                                @can('view_processo_visitante')
                                                    <a href="{{route('processo_visitante.show', compact('solicitacao_visitante', 'processo_visitante'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar o Processo da Solicitação do Visitante"></i></a>
                                                @endcan

                                                @can('delete_processo_visitante')
                                                        <a href="javascript:;" data-toggle="modal"
                                                        onclick="deleteData('processo', '{{$solicitacao_visitante->id}}', '{{$processo_visitante->id}}');"
                                                            data-target="#modal-delete"><i class="fa fa-minus-circle"
                                                                style="color: crimson" title="Excluir o Processo da Solicitação do Visitante"></i></a>
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
                        </div>    
                    </div>

                    @section('modal_target')"formSubmit();"@endsection
                    @section('modal_type')@endsection
                    @section('modal_name')"modal-delete"@endsection
                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                    @section('modal_msg_description')O registro selecionado será excluído definitivamente. @endsection
                    @section('modal_close')Fechar @endsection
                    @section('modal_save')Excluir @endsection

                    <form action="" id="deleteForm" method="post">
                        @csrf
                        @method('DELETE')
                    </form>


            <!-- FORMULÁRIO - FIM -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-js')
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>

        @if($solicitacao_visitante->processo_visitantes->count() > 0)
            <script>
                var table = $('#dt_processo_visitantes').DataTable({
                    language: {
                        url: '{{ asset('nazox/assets/localisation/pt_br.json') }}'
                    },
                    "order": [
                        [1, "asc"]
                    ]
                });
            </script>
        @endif  	

        <script>
            function formSubmit() {
                $("#deleteForm").submit();
            }

            function deleteData(origem, solicitacao_visitante, processo_visitante) {
                var origem = origem;
                var solicitacao_visitante = solicitacao_visitante;

                if(origem == 'processo'){
                    var processo_visitante = processo_visitante;
                    var url = '{{ route('processo_visitante.destroy', [':solicitacao_visitante', ':processo_visitante']) }}';
                    url = url.replace(':solicitacao_visitante', solicitacao_visitante);
                    url = url.replace(':processo_visitante', processo_visitante);
                    $("#deleteForm").attr('action', url);
                }

            }
        </script>    
@endsection
