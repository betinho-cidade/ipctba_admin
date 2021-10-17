@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações do Histórico da Solicitação</h4>
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

<small style="color: mediumpurple">{!! $membro->breadcrumb !!}</small>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 class="card-title">Formulário de Atualização - Histórico da Solicitação</h4>
            <p class="card-title-desc">Informações do histórico da Solicitação para o membro.</p>
            <form name="edit_historico_solicitacao" method="POST" action="{{route('historico_solicitacao.update', compact('membro', 'historico_solicitacao'))}}"  class="needs-validation"  novalidate>
                @csrf
                @method('put')

                <!-- Dados - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Histório da Solicitação</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_solicitacao">Tipo de Solicitação</label>
                                <input type="text" disabled class="form-control" value="{{$historico_solicitacao->tipo_solicitacao->nome}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lider">Líder</label>
                                <select id="lider" name="lider" class="form-control" required>
                                    <option value="">---</option>
                                    @foreach($liders as $lider)
                                        <option value="{{$lider->id}}" {{($lider->id == $historico_solicitacao->lider_id) ? 'selected' : '' }}>({{ $lider->historico_oficio_atual }}) {{$lider->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_agendamento">Data Agendamento</label>
                                <input type="date" class="form-control" id="data_agendamento" name="data_agendamento"
                                    value="{{ $historico_solicitacao->data_agendamento_ajustada}}" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_agendamento">Hora Agendamento</label>
                                <input type="time" class="form-control" id="hora_agendamento" name="hora_agendamento"
                                    value="{{ $historico_solicitacao->hora_agendamento_ajustada }}" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comentario">Comentários</label>
                                <textarea class="form-control" rows="6" id="comentario" name="comentario" placeholder="Comentários...">{{ $historico_solicitacao->comentario }}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_realizacao">Data Realização</label>
                                        <input type="date" class="form-control" id="data_realizacao" name="data_realizacao"
                                            value="{{ $historico_solicitacao->data_realizacao_ajustada}}">
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hora_realizacao">Hora Realização</label>
                                        <input type="time" class="form-control" id="hora_realizacao" name="hora_realizacao"
                                            value="{{ $historico_solicitacao->hora_realizacao_ajustada }}">
                                        <div class="valid-feedback">ok!</div>
                                        <div class="invalid-feedback">Inválido!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="repetir_solicitacao">Repetir Solicitação</label>
                                        <select id="repetir_solicitacao" name="repetir_solicitacao" class="form-control">
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

                <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
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
    <!-- form mask -->
    <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>
@endsection
