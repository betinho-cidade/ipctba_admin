@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Novo Vínculo Familiar</h4>
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

            <h4 class="card-title">Formulário de Cadastro - Vínculo Familiar</h4>
            <p class="card-title-desc">Informe novo Vínculo Familiar para o membro.</p>
            <form name="create_membro_familia" method="POST" action="{{route('membro_familia.store', compact('membro'))}}"  class="needs-validation"  novalidate>
                @csrf

                <!-- Dados - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Vínculo Familiar</h5>
                </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vinculo">Vínculo Familiar</label>
                                <select id="vinculo" name="vinculo" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="P" {{(old('vinculo') == 'P') ? 'selected' : '' }}>Pai</option>
                                    <option value="M" {{(old('vinculo') == 'M') ? 'selected' : '' }}>Mãe</option>
                                    <option value="F" {{(old('vinculo') == 'F') ? 'selected' : '' }}>Filho(a)</option>
                                    <option value="C" {{(old('vinculo') == 'C') ? 'selected' : '' }}>Cônjuge</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="membro_familia">Membro da Família</label>
                                <select id="membro_familia" name="membro_familia" class="form-control select2" required>
                                    <option value="">---</option>
                                    @foreach($novo_membros as $membro_familia)
                                        <option value="{{$membro_familia->id}}">{{$membro_familia->nome}}</option>
                                    @endforeach
                                </select>

                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>

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
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
    <script src="{{ asset('nazox/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('nazox/assets/js/pages/form-advanced.init.js') }}"></script>

    <!-- form mask -->
    <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>
@endsection
