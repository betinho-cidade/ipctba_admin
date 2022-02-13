@extends('painel.layout.index')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Nova Agenda / Solicitação para o Membro</h4>
            </div>
        </div>
    </div>

    @if (session()->has('message.level'))
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

                    <h4 class="card-title">Formulário de Cadastro - Agenda / Solicitação</h4>
                    <p class="card-title-desc">Abaixo você pode criar uma nova agenda/solicitação para um membro específico.
                    </p>

                    <form name="create_agenda_solicitacao" method="POST" action="{{ route('agenda_solicitacao.store') }}"
                        class="needs-validation" novalidate>
                        @csrf

                        <!-- Dados - INI -->
                        <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                            <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Agenda / Solicitação
                            </h5>
                        </div>

                        @if ($user->roles->contains('name', 'Gestor') || $user->roles->contains('name', 'Pastor'))
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_solicitacao">Tipo de Solicitação</label>
                                        <select id="tipo_solicitacao" name="tipo_solicitacao" class="form-control"
                                            required>
                                            <option value="">---</option>
                                            @foreach ($tipo_solicitacaos as $tipo_solicitacao)
                                                <option value="{{ $tipo_solicitacao->id }}"
                                                    {{ $tipo_solicitacao->id == old('tipo_solicitacao') ? 'selected' : '' }}>
                                                    {{ $tipo_solicitacao->nome }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="membro">Membro</label>
                                        <select id="membro" name="membro" class="form-control select2" required>
                                            <option value="">---</option>
                                            @foreach ($liders as $membro)
                                                <option value="{{ $membro->id }}"
                                                    {{ $membro->id == old('membro') ? 'selected' : '' }}>
                                                    {{ $membro->nome }}</option>
                                            @endforeach
                                        </select>

                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lider">Líder</label>
                                        <select id="lider" name="lider" class="form-control select2">
                                            <option value="">---</option>
                                            @foreach ($liders as $lider)
                                                @if($lider->historico_oficio_atual != ' --- ')
                                                    <option value="{{ $lider->id }}"
                                                        {{ $lider->id == old('lider') ? 'selected' : '' }}>
                                                        ({{ $lider->historico_oficio_atual }}) {{ $lider->nome }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comentario">Comentários</label>
                                        <textarea class="form-control" rows="3" id="comentario" name="comentario"
                                            placeholder="Comentários...">{{ old('comentario') }}</textarea>
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="data_agendamento">Data Agendamento</label>
                                        <input type="date" class="form-control" id="data_agendamento"
                                            name="data_agendamento" value="{{ old('data_agendamento') }}">
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hora_agendamento">Hora Agendamento</label>
                                        <input type="time" class="form-control" id="hora_agendamento"
                                            name="hora_agendamento" value="{{ old('hora_agendamento') }}">
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_solicitacao">Tipo de Solicitação</label>
                                        <select id="tipo_solicitacao" name="tipo_solicitacao" class="form-control"
                                            required>
                                            <option value="">---</option>
                                            @foreach ($tipo_solicitacaos as $tipo_solicitacao)
                                                <option value="{{ $tipo_solicitacao->id }}"
                                                    {{ $tipo_solicitacao->id == old('tipo_solicitacao') ? 'selected' : '' }}>
                                                    {{ $tipo_solicitacao->nome }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="membro">Membro</label>
                                        <select id="membro" name="membro" class="form-control select2" required>
                                            <option value="">---</option>
                                            @foreach ($liders as $membro)
                                                <option value="{{ $membro->id }}"
                                                    {{ $membro->id == old('membro') ? 'selected' : '' }}>
                                                    {{ $membro->nome }}</option>
                                            @endforeach
                                        </select>

                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comentario">Comentários</label>
                                        <textarea class="form-control" rows="3" id="comentario" name="comentario"
                                            placeholder="Comentários...">{{ old('comentario') }}</textarea>
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>

                            </div>
                        @endif

                        <!-- Dados -- FIM -->

                        <button class="btn btn-primary" type="submit">Salvar Cadastro</button>
                    </form>

                    <!-- FORMULÁRIO - FIM -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('head-css')
    <link href="{{ asset('nazox/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('script-js')
    <script src="{{ asset('nazox/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('nazox/assets/js/pages/form-element.init.js') }}"></script>
    <!-- form mask -->
    <script src="{{ asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>

    <script src="{{ asset('nazox/assets/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('nazox/assets/js/pages/form-advanced.init.js') }}"></script>

@endsection
