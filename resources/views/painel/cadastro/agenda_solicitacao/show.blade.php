@extends('painel.layout.index')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Informações da Agenda / Solicitação</h4>
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

    <small style="color: mediumpurple">{!! $agenda_solicitacao->membro->breadcrumb !!}</small>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- FORMULÁRIO - INICIO -->

                    @can('edit_agenda_solicitacao')
                        <h4 class="card-title">Formulário de Atualização - Agenda / Solicitação - {{ strtoupper($agenda_solicitacao->membro->nome) }}</h4>
                        <p class="card-title-desc">Abaixo você pode atualizar a agenda/solicitação do membro.
                    @endcan

                    <form name="edit_agenda_solicitacao" method="POST"
                        action="{{ route('agenda_solicitacao.update', compact('agenda_solicitacao')) }}"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('put')

                        <!-- Dados - INI -->
                        <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                            <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Agenda / Solicitação
                            </h5>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_solicitacao">Tipo de Solicitação</label>
                                    <input type="text" disabled class="form-control"
                                        value="{{ $agenda_solicitacao->tipo_solicitacao->nome }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="membro">Membro</label>
                                    <input type="text" disabled class="form-control"
                                        value="{{ $agenda_solicitacao->membro->nome }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lider">Líder</label>
                                    <select @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif id="lider" name="lider" class="form-control select2" required>
                                        <option value="">---</option>
                                        @foreach ($liders as $lider)
                                            @if ($lider->historico_oficio_atual != ' --- ')
                                                <option value="{{ $lider->id }}"
                                                    {{ $lider->id == $agenda_solicitacao->lider_id ? 'selected' : '' }}>
                                                    ({{ $lider->historico_oficio_atual }}) {{ $lider->nome }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="membro">Criado em: {{ $agenda_solicitacao->data_criacao_formatada }}</label>
                                    <input type="text" disabled class="form-control"
                                        value="{{ $agenda_solicitacao->user->name }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comentario">Comentários</label>
                                    <textarea @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif class="form-control" rows="9" id="comentario" name="comentario"
                                        placeholder="Comentários...">{{ $agenda_solicitacao->comentario }}</textarea>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="data_agendamento">Data Agendamento</label>
                                            <input @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif type="date" class="form-control" id="data_agendamento"
                                                name="data_agendamento"
                                                value="{{ $agenda_solicitacao->data_agendamento_ajustada }}" required>
                                            <div class="valid-feedback">ok!</div>
                                            <div class="invalid-feedback">Inválido!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_agendamento">Hora Agendamento</label>
                                            <input @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif type="time" class="form-control" id="hora_agendamento"
                                                name="hora_agendamento"
                                                value="{{ $agenda_solicitacao->hora_agendamento_ajustada }}" required>
                                            <div class="valid-feedback">ok!</div>
                                            <div class="invalid-feedback">Inválido!</div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="data_realizacao">Data Realização</label>
                                            <input @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif type="date" class="form-control" id="data_realizacao"
                                                name="data_realizacao"
                                                value="{{ $agenda_solicitacao->data_realizacao_ajustada }}">
                                            <div class="valid-feedback">ok!</div>
                                            <div class="invalid-feedback">Inválido!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_realizacao">Hora Realização</label>
                                            <input @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif type="time" class="form-control" id="hora_realizacao"
                                                name="hora_realizacao"
                                                value="{{ $agenda_solicitacao->hora_realizacao_ajustada }}">
                                            <div class="valid-feedback">ok!</div>
                                            <div class="invalid-feedback">Inválido!</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="repetir_solicitacao">Repetir Solicitação</label>
                                            <select @if(!Gate::check('edit_agenda_solicitacao') || $agenda_solicitacao->status == 'CL') disabled @endif id="repetir_solicitacao" name="repetir_solicitacao"
                                                class="form-control">
                                                <option value="">---</option>
                                                <option value="0">Não Repetir</option>
                                                <option value="7">7 dias</option>
                                                <option value="15">15 dias</option>
                                                <option value="30">30 dias</option>
                                            </select>
                                            <div class="valid-feedback">ok!</div>
                                            <div class="invalid-feedback">Inválido!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dados -- FIM -->

                        @can('edit_agenda_solicitacao')
                            @if($agenda_solicitacao->status != 'CL')
                                <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
                            @endif
                        @endcan
                    </form>

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
