@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações da Ficha de Atualização</h4>
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

<small style="color: mediumpurple">{!! $membro_ficha->breadcrumb !!}</small>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 class="card-title">Formulário de Solicitação de Atualização - Atualização do Dados Cadastrais <span class="float-right {{ ($membro_ficha->status == 'C' ? 'bg-success' : 'bg-warning') }}" style="color: white;font-size: 26px;">&nbsp;{{ $membro_ficha->descricao_status }}&nbsp;</span></h4>
            <p class="card-title-desc">A solicitação de atualização de ficha cadastral será enviada aos responsáveis para análise e efetivação.</p>
            <form name="edit_membro_ficha" method="POST" action="{{route('membro_ficha.update', compact('membro_ficha'))}}"  class="needs-validation"  accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                @if($membro_ficha->status == 'AL' || $membro_ficha->status == 'C')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lider">Solicitado por</label>
                            <input disabled type="text" class="form-control" value="{{($membro_ficha->lider ? $membro_ficha->lider->nome : '')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="membro_sol">Membro para Atualização Cadastral</label>
                            <input disabled type="text" class="form-control" value="{{($membro_ficha->membro ? $membro_ficha->membro->nome : '')}}">
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                    </div>
                </div>
                <p></p>
                @elseif($membro_ficha->status == 'AS')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="membro_sol">Membro para Atualização Cadastral</label>
                            <select @if(!Gate::check('edit_membro_ficha')) disabled @endif id="membro_sol" name="membro_sol" class="form-control dynamic_membro" required>
                                <option value="">---</option>
                                @foreach($membros as $membro_lst)
                                    <option value="{{$membro_lst->id}}" {{($membro_lst->id == $membro_sol) ? 'selected' : '' }}>{{$membro_lst->nome}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                    </div>
                </div>
                <p></p>
                @endif

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                @if($membro && $membro->nome !== $membro_ficha->nome)
                                    <i class="fas fa-envelope-open-text" title="{{ $membro->nome ?? '---' }}" style="color:red"></i></a>
                                @endif
                                <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" class="form-control" id="nome" name="nome" value="{{$membro_ficha->nome}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_membro">E-mail</label>
                                @if($membro && $membro->email !== $membro_ficha->email)
                                    <i class="fas fa-envelope-open-text" title="{{ $membro->email ?? '---' }}" style="color:red"></i></a>
                                @endif
                                <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="email" class="form-control" id="email_membro" name="email_membro" value="{{$membro_ficha->email}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="celular">Telefone Celular</label>
                            @if($membro && $membro->celular !== $membro_ficha->celular)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->celular ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="celular" id="celular" class="form-control mask_celular" value="{{$membro_ficha->celular}}">
                        </div>
                        <div class="col-md-4">
                            <label for="data_nascimento">Data Nascimento</label>
                            @if($membro && $membro->data_nascimento !== $membro_ficha->data_nascimento)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->data_nascimento_formatada ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{$membro_ficha->data_nascimento}}">
                        </div>
                        <div class="col-md-4">
                            <label for="naturalidade">Naturalidade</label>
                            @if($membro && $membro->naturalidade !== $membro_ficha->naturalidade)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->naturalidade ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="naturalidade" id="naturalidade" class="form-control" value="{{$membro_ficha->naturalidade}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Pessoais - FIM -->


                <!-- Dados Complementares - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Complementares</h5>
                </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="estado_civil">Estado Civil</label>
                            @if($membro && $membro->estado_civil !== $membro_ficha->estado_civil)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->descricao_estado_civil ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <select @if(!Gate::check('edit_membro_ficha')) disabled @endif id="estado_civil" name="estado_civil" class="form-control">
                                <option value="">---</option>
                                <option value="SL" {{($membro_ficha->estado_civil == 'SL') ? 'selected' : '' }}>Solteiro</option>
                                <option value="CS" {{($membro_ficha->estado_civil == 'CS') ? 'selected' : '' }}>Casado</option>
                                <option value="SP" {{($membro_ficha->estado_civil == 'SP') ? 'selected' : '' }}>Separado</option>
                                <option value="DV" {{($membro_ficha->estado_civil == 'DV') ? 'selected' : '' }}>Divorciado</option>
                                <option value="VI" {{($membro_ficha->estado_civil == 'VI') ? 'selected' : '' }}>Viúvo</option>
                                <option value="UE" {{($membro_ficha->estado_civil == 'UE') ? 'selected' : '' }}>União Estável</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="conjuge">Nome Cônjuge</label>
                                @if($membro && $membro->conjuge !== $membro_ficha->conjuge)
                                    <i class="fas fa-envelope-open-text" title="{{ $membro->conjuge ?? '---' }}" style="color:red"></i></a>
                                @endif
                                <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" class="form-control" id="conjuge" name="conjuge" value="{{$membro_ficha->conjuge}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="data_casamento">Data Casamento</label>
                            @if($membro && $membro->data_casamento !== $membro_ficha->data_casamento)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->data_casamento_formatada ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="date" name="data_casamento" id="data_casamento" class="form-control" value="{{$membro_ficha->data_casamento}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="escolaridade">Escolaridade</label>
                            @if($membro && $membro->escolaridade !== $membro_ficha->escolaridade)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->descricao_escolaridade ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <select @if(!Gate::check('edit_membro_ficha')) disabled @endif id="escolaridade" name="escolaridade" class="form-control">
                                <option value="">---</option>
                                <option value="EF" {{($membro_ficha->escolaridade == 'EF') ? 'selected' : '' }}>Ensino Fundamental</option>
                                <option value="EM" {{($membro_ficha->escolaridade == 'EM') ? 'selected' : '' }}>Ensino Médio</option>
                                <option value="EP" {{($membro_ficha->escolaridade == 'EP') ? 'selected' : '' }}>Ensino Profissionalizante</option>
                                <option value="ES" {{($membro_ficha->escolaridade == 'ES') ? 'selected' : '' }}>Ensino Superior</option>
                                <option value="MS" {{($membro_ficha->escolaridade == 'MS') ? 'selected' : '' }}>Mestrado</option>
                                <option value="DO" {{($membro_ficha->escolaridade == 'DO') ? 'selected' : '' }}>Doutorado</option>
                                <option value="PD" {{($membro_ficha->escolaridade == 'PD') ? 'selected' : '' }}>Pós Doutorado</option>
                                <option value="NA" {{($membro_ficha->escolaridade == 'NA') ? 'selected' : '' }}>Não Alfabetizado</option>
                                <option value="AL" {{($membro_ficha->escolaridade == 'AL') ? 'selected' : '' }}>Alfabetizado</option>
                                <option value="NI" {{($membro_ficha->escolaridade == 'N1') ? 'selected' : '' }}>Não Informada</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-3">
                            <label for="profissao">Profissão</label>
                            @if($membro && $membro->profissao !== $membro_ficha->profissao)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->profissao ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="profissao" id="profissao" class="form-control" value="{{$membro_ficha->profissao}}">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_pai">Nome do Pai</label>
                            @if($membro && $membro->nome_pai !== $membro_ficha->nome_pai)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->nome_pai ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="nome_pai" id="nome_pai" class="form-control" value="{{$membro_ficha->nome_pai}}">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_mae">Nome da Mãe</label>
                            @if($membro && $membro->nome_mae !== $membro_ficha->nome_mae)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->nome_mae ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="nome_mae" id="nome_mae" class="form-control" value="{{$membro_ficha->nome_mae}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Complementares - FIM -->

                <!-- Dados Endereço - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Endereço</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="end_cep">CEP</label>
                            @if($membro && $membro->end_cep !== $membro_ficha->end_cep)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_cep ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{$membro_ficha->end_cep}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_cidade">Cidade</label>
                            @if($membro && $membro->end_cidade !== $membro_ficha->end_cidade)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_cidade ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{$membro_ficha->end_cidade}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_uf">Estado</label>
                            @if($membro && $membro->end_estado !== $membro_ficha->end_estado)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_estado ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="end_uf" id="end_uf" class="form-control" value="{{$membro_ficha->end_uf}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_bairro">Bairro</label>
                            @if($membro && $membro->end_bairro !== $membro_ficha->end_bairro)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_bairro ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{$membro_ficha->end_bairro}}">
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="end_endereco">Endereço</label>
                            @if($membro && $membro->end_logradouro !== $membro_ficha->end_logradouro)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_logradouro ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{$membro_ficha->end_logradouro}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_numero">Número</label>
                            @if($membro && $membro->end_numero !== $membro_ficha->end_numero)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_numero ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif type="text" name="end_numero" id="end_numero" value="{{$membro_ficha->end_numero}}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="end_complemento">Complemento </label>
                            @if($membro && $membro->end_complemento !== $membro_ficha->end_complemento)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_complemento ?? '---' }}" style="color:red"></i></a>
                            @endif
                            <input @if(!Gate::check('edit_membro_ficha')) disabled @endif ="text" name="end_complemento" id="end_complemento" class="form-control" value="{{$membro_ficha->end_complemento}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Endereço - FIM -->

                @can('edit_membro_ficha')
                    @if($membro_ficha->status != 'C')
                        <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                            <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Atualização os Dados Cadastrais</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="acao_ficha">Escolha a ação para finalizar a ficha.</label>
                                <select id="acao_ficha" name="acao_ficha" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="C">Atualizar e Concluir a Ficha</option>
                                </select>
                            </div>
                        </div>
                        <p></p>
                        <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
                    @endif
                @endcan
            </form>
            <!-- FORMULÁRIO - FIM -->

            </div>
        </div>
    </div>
</div>

@endsection

@section('head-css')
    <link href="{{asset('nazox/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection


@section('script-js')
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/select2/js/select2.min.js')}}"></script>

    <!-- form mask -->
    <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
		$(document).ready(function(){
			$('.mask_cep').inputmask('99.999-999');
            $('.mask_celular').inputmask('(99) 99999-9999');
            $('.select2').select2();
		});
	</script>

    <script type='text/javascript'>
        $(document).ready(function(){
            $('.dynamic_membro').change(function(){

                if ($(this).val() != ''){

                    var membro = $('#membro_sol').val();
                    var _token = $('input[name="_token"]').val();
                    var url = "{{route('membro_ficha.show', compact('membro_ficha'))}}";

                    location.href = url + '?membro_sol=' + membro;
                    location.submit;
                }
            });
        });
    </script>


@endsection
