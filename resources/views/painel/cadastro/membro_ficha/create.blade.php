@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Nova Ficha de Atualização</h4>
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

            <h4 class="card-title">Formulário de Solicitação de Atualização - Dados Cadastrais</h4>
            <p class="card-title-desc">A solicitação de atualização de ficha cadastral será enviada aos responsáveis para análise e efetivação.</p>
            <form name="create_membro_ficha" method="POST" action="{{route('membro_ficha.store')}}"  class="needs-validation"  novalidate>
                @csrf


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lider">Solicitado por</label>
                            <select id="lider" name="lider" class="form-control" required>
                                <option value="{{$user->membro->id}}">{{$user->membro->nome}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="membro_sol">Membro para Atualização Cadastral</label>
                            <select id="membro_sol" name="membro_sol" class="form-control select2 dynamic_membro" required>
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

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                @if($membro && $membro->nome)
                                    <i class="fas fa-envelope-open-text" title="{{ $membro->nome ?? '---' }}"></i></a>
                                @endif
                                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_membro}">E-mail</label>
                                @if($membro && $membro->email)
                                    <i class="fas fa-envelope-open-text" title="{{ $membro->email ?? '---' }}"></i></a>
                                @endif
                                <input type="email" class="form-control" id="email_membro" name="email_membro" value="{{old('email_membro')}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="celular">Telefone Celular</label>
                            @if($membro && $membro->celular)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->celular ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{old('celular')}}">
                        </div>
                        <div class="col-md-4">
                            <label for="data_nascimento">Data Nascimento</label>
                            @if($membro && $membro->data_nascimento)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->data_nascimento_formatada ?? '---' }}"></i></a>
                            @endif
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{old('data_nascimento')}}">
                        </div>
                        <div class="col-md-4">
                            <label for="naturalidade">Local de Nascimento</label>
                            @if($membro && $membro->naturalidade)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->naturalidade ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="naturalidade" id="naturalidade" class="form-control" value="{{old('naturalidade')}}">
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
                            @if($membro && $membro->estado_civil)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->descricao_estado_civil ?? '---' }}"></i></a>
                            @endif
                            <select id="estado_civil" name="estado_civil" class="form-control">
                                <option value="">---</option>
                                <option value="SL" {{(old('estado_civil') == 'SL') ? 'selected' : '' }}>Solteiro</option>
                                <option value="CS" {{(old('estado_civil') == 'CS') ? 'selected' : '' }}>Casado</option>
                                <option value="SP" {{(old('estado_civil') == 'SP') ? 'selected' : '' }}>Separado</option>
                                <option value="DV" {{(old('estado_civil') == 'DV') ? 'selected' : '' }}>Divorciado</option>
                                <option value="VI" {{(old('estado_civil') == 'VI') ? 'selected' : '' }}>Viúvo</option>
                                <option value="UE" {{(old('estado_civil') == 'UE') ? 'selected' : '' }}>União Estável</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="conjuge">Nome Cônjuge</label>
                                @if($membro && $membro->conjuge)
                                    <i class="fas fa-envelope-open-text" title="{{ $membro->conjuge ?? '---' }}"></i></a>
                                @endif
                                <input type="text" class="form-control" id="conjuge" name="conjuge" value="{{old('conjuge')}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="data_casamento">Data Casamento</label>
                            @if($membro && $membro->data_casamento)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->data_casamento_formatada ?? '---' }}"></i></a>
                            @endif
                            <input type="date" name="data_casamento" id="data_casamento" class="form-control" value="{{old('data_casamento')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="escolaridade">Escolaridade</label>
                            @if($membro && $membro->escolaridade)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->descricao_escolaridade ?? '---' }}"></i></a>
                            @endif
                            <select id="escolaridade" name="escolaridade" class="form-control">
                                <option value="">---</option>
                                <option value="EF" {{(old('escolaridade') == 'EF') ? 'selected' : '' }}>Ensino Fundamental</option>
                                <option value="EM" {{(old('escolaridade') == 'EM') ? 'selected' : '' }}>Ensino Médio</option>
                                <option value="EP" {{(old('escolaridade') == 'EP') ? 'selected' : '' }}>Ensino Profissionalizante</option>
                                <option value="ES" {{(old('escolaridade') == 'ES') ? 'selected' : '' }}>Ensino Superior</option>
                                <option value="MS" {{(old('escolaridade') == 'MS') ? 'selected' : '' }}>Mestrado</option>
                                <option value="DO" {{(old('escolaridade') == 'DO') ? 'selected' : '' }}>Doutorado</option>
                                <option value="PD" {{(old('escolaridade') == 'PD') ? 'selected' : '' }}>Pós Doutorado</option>
                                <option value="NA" {{(old('escolaridade') == 'NA') ? 'selected' : '' }}>Não Alfabetizado</option>
                                <option value="AL" {{(old('escolaridade') == 'AL') ? 'selected' : '' }}>Alfabetizado</option>
                                <option value="NI" {{(old('escolaridade') == 'N1') ? 'selected' : '' }}>Não Informada</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-3">
                            <label for="profissao">Profissão</label>
                            @if($membro && $membro->profissao)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->profissao ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="profissao" id="profissao" class="form-control" value="{{old('profissao')}}">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_pai">Nome do Pai</label>
                            @if($membro && $membro->nome_pai)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->nome_pai ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="nome_pai" id="nome_pai" class="form-control" value="{{old('nome_pai')}}">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_mae">Nome da Mãe</label>
                            @if($membro && $membro->nome_mae)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->nome_mae ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="nome_mae" id="nome_mae" class="form-control" value="{{old('nome_mae')}}">
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
                            @if($membro && $membro->end_cep)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_cep ?? '---' }}"></i></a>
                            @endif
                            <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                            <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{old('end_cep')}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_cidade">Cidade</label>
                            @if($membro && $membro->end_cidade)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_cidade ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{old('end_cidade')}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_uf">Estado</label>
                            @if($membro && $membro->end_estado)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_estado ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{old('end_uf')}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_bairro">Bairro</label>
                            @if($membro && $membro->end_bairro)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_bairro ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{old('end_bairro')}}">
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="end_endereco">Endereço</label>
                            @if($membro && $membro->end_logradouro)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_logradouro ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{old('end_logradouro')}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_numero">Número</label>
                            @if($membro && $membro->end_numero)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_numero ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="end_numero" id="end_numero" value="{{old('end_numero')}}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="end_complemento">Complemento </label>
                            @if($membro && $membro->end_complemento)
                                <i class="fas fa-envelope-open-text" title="{{ $membro->end_complemento ?? '---' }}"></i></a>
                            @endif
                            <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{old('end_complemento')}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Endereço - FIM -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="invalidCheck" required>
                                        <label class="custom-control-label" for="invalidCheck">Aceito os termos e condições acima</label>
                                        <div class="invalid-feedback">
                                            Você deve aceitar os termos antes de enviar o formulário.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Dados Ministeriais -- FIM -->

                <button class="btn btn-primary" type="submit">Salvar Cadastro</button>
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
            $('.mask_cpf').inputmask('999.999.999-99');
            $('.mask_celular').inputmask('(99) 99999-9999');
            $('.select2').select2();
		});
	</script>

    <script type='text/javascript'>
        $(document).ready(function(){
            $('.dynamic_cep').change(function(){

                if ($(this).val() != ''){
                    document.getElementById("img-loading-cep").style.display = '';

                    var cep = $('#end_cep').val();
                    var _token = $('input[name="_token"]').val();

                    $('#end_logradouro').val('');
                    $('#end_complemento').val('');
                    $('#end_numero').val('');
                    $('#end_bairro').val('');
                    $('#end_cidade').val('');
                    $('#end_uf').val('');

                    $.ajax({
                        url: "{{route('painel.js_viacep')}}",
                        method: "POST",
                        data: {_token:_token, cep:cep},
                        success:function(result){
                            dados = JSON.parse(result);
                            if(dados==null || dados['error'] == 'true'){
                                    console.log(dados);
                            } else{
                                    $('#end_logradouro').val(dados['logradouro']);
                                    $('#end_complemento').val(dados['complemento']);
                                    $('#end_bairro').val(dados['bairro']);
                                    $('#end_cidade').val(dados['localidade']);
                                    $('#end_uf').val(dados['uf']);
                            }
                            document.getElementById("img-loading-cep").style.display = 'none';
                        },
                        error:function(erro){
                            document.getElementById("img-loading-cep").style.display = 'none';
                        }
                    })
                }
            });
        });
    </script>

    <script type='text/javascript'>
        $(document).ready(function(){
            $('.dynamic_membro').change(function(){

                if ($(this).val() != ''){

                    var membro = $('#membro_sol').val();
                    var _token = $('input[name="_token"]').val();
                    var url = "{{route('membro_ficha.create')}}";

                    location.href = url + '?membro_sol=' + membro;
                    location.submit;
                }
            });
        });
    </script>

@endsection
