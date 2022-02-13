@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações do Histórico do Ofício</h4>
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

            <h4 class="card-title">Formulário de Atualização - Histórico do Ofício</h4>
            <p class="card-title-desc">Informações do histórico do Ofício para o membro.</p>
            <form name="edit_historico_oficio" method="POST" action="{{route('historico_oficio.update', compact('membro', 'historico_oficio'))}}"  class="needs-validation"  novalidate>
                @csrf
                @method('put')

                <!-- Dados - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Histórico do Ofício</h5>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="oficio">Ofício</label>
                                <input type="text" disabled class="form-control" value="{{$historico_oficio->oficio->nome}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_inicio">Data Início</label>
                                <input type="date" disabled class="form-control" value="{{$historico_oficio->data_inicio_ajustada}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_fim">Data Fim</label>
                                <input type="date" class="form-control" id="data_fim" name="data_fim" value="{{$historico_oficio->data_fim_ajustada}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comentario">Comentários</label>
                                <textarea class="form-control" rows="3" id="comentario" name="comentario" placeholder="Comentários...">{{ $historico_oficio->comentario }}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
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
