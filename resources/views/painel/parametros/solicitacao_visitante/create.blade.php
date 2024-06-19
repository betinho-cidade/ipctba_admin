@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Nova Solicitação do Visitante do Sistema</h4>
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

            <h4 class="card-title">Formulário de Cadastro - Solicitação</h4>
            <p class="card-title-desc">A Solicitação cadastrada será utilizada no preenchimento da Ficha do Visitante.</p>
            <form name="create_solicitacao_visitante" method="POST" action="{{route('solicitacao_visitante.store')}}"  class="needs-validation" novalidate>
                @csrf

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados da Solicitação</h5>
                </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" placeholder="Solicitação" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="origem">Origem</label>
                                <select id="origem" name="origem" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="GR" {{(old('origem') == 'GR') ? 'selected' : '' }}>Geral</option>
                                    <option value="ES" {{(old('origem') == 'ES') ? 'selected' : '' }}>Específica</option>
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
                                    <option value="S" {{(old('informar_motivo') == 'S') ? 'selected' : '' }}>Sim</option>
                                    <option value="N" {{(old('informar_motivo') == 'N') ? 'selected' : '' }}>Não</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>

                <button class="btn btn-primary" type="submit">Salvar Cadastro</button>
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
@endsection
