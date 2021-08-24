@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações do Usuário</h4>
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

            <h4 class="card-title">Formulário de Atualização - Usuário {{$usuario->name}}</h4>
            <p class="card-title-desc">O usuário cadastrado poderá acessar ao sistema e realizar as ações necessárias conforme seu perfil de acesso GESTOR ou ASSINANTE. Cada usuário somente poderá ter um ÚNICO perfil associado.</p>

            <form name="edit_usuario" method="POST" action="{{route('usuario.update', compact('usuario'))}}"  class="needs-validation" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{$usuario->name}}" placeholder="Nome" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$usuario->email}}" placeholder="E-mail" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control mask_cpf" value="{{$usuario->cpf}}" placeholder="(999.999.999-99)" required>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="telefone_ddd">DDD</label>
                            <input type="text" name="telefone_ddd" id="telefone_ddd" class="form-control mask_ddd" value="{{$usuario->telefone_ddd}}" placeholder="(99)" required>
                        </div>
                        <div class="col-md-2">
                            <label for="telefone">Telefone Celular</label>
                            <input type="text" name="telefone" id="telefone" class="form-control mask_telefone" value="{{$usuario->telefone}}" placeholder="99999-9999" required>
                        </div>
                        <div class="col-md-3">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{$usuario->data_nascimento_ajustada}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="path_avatar"></label> <br>
                            <a class="image-popup-no-margins" href="{{$usuario->avatar}}">
                                <img class="avatar-sm mr-3 rounded-circle" alt="200x200" width="200" src="{{$usuario->avatar}}" data-holder-rendered="true">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <label for="path_avatar">Avatar Usuário</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" id="path_avatar" name="path_avatar" accept="image/*">
                                <label class="custom-file-label" for="path_avatar">Selecionar Avatar</label>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="parceiro">Como ficou sabendo sobre a Plataforma</label>
                                <select id="parceiro" name="parceiro" class="form-control dynamic_assinatura">
                                    <option value="">Outros</option>
                                    @foreach($parceiros as $parceiro)
                                        <option value="{{$parceiro->id}}" {{($parceiro->id == $usuario->parceiro_id) ? 'selected' : '' }}>{{$parceiro->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Pessoais - FIM -->

                <!-- Dados Endereço - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Endereço</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="end_cep">CEP</label>
                            <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                            <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{$usuario->end_cep}}" placeholder="99.999-999" required>
                        </div>

                        <div class="col-md-4">
                            <label for="end_cidade">Cidade</label>
                            <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{$usuario->end_cidade}}" required>
                        </div>

                        <div class="col-md-2">
                            <label for="end_uf">Estado</label>
                            <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{$usuario->end_uf}}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="end_bairro">Bairro</label>
                            <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{$usuario->end_bairro}}" required>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="end_endereco">Endereço</label>
                            <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{$usuario->end_logradouro}}" required>
                        </div>

                        <div class="col-md-2">
                            <label for="end_numero">Número</label>
                            <input type="text" name="end_numero" id="end_numero" value="{{$usuario->end_numero}}" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="end_complemento">Complemento </label>
                            <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{$usuario->end_complemento}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Endereço - FIM -->

                <!-- Dados Acesso -- INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Acesso</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao">Situação</label>
                                <select id="situacao" name="situacao" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="A" {{($usuario->situacao['status'] == 'A') ? 'selected' : '' }}>Ativo</option>
                                    <option value="I" {{($usuario->situacao['status'] == 'I') ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="perfil">Perfil Acesso</label>
                                <input type="text" class="form-control" value="{{$usuario->perfil}}" disabled>
                                {{-- @if($usuario->perfil == 'Gestor')
                                    <select disabled id="perfil" name="perfil" class="form-control">
                                        <option value="{{$usuario->perfil_id}}">Gestor</option>
                                    </select>
                                @else
                                    <select id="perfil" name="perfil" class="form-control dynamic_perfil" required>
                                        <option value="">---</option>
                                        @foreach($perfis as $perfil)
                                            @if($perfil->name != 'Gestor')
                                                <option value="{{$perfil->id}}" {{($perfil->id == $usuario->perfil_id) ? 'selected' : '' }}>{{$perfil->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                @endif --}}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="assinatura">Assinatura</label>
                                <input type="text" class="form-control" value="{{$usuario->assinatura}}" disabled>
                                {{-- @if($usuario->perfil == 'Gestor')
                                    <select disabled id="assinatura" name="assinatura" class="form-control">
                                        <option value="G">Gestor</option>
                                    </select>
                                @else
                                    <select id="assinatura" name="assinatura" class="form-control dynamic_assinatura" required>
                                        <option value="">---</option>
                                        <option value="K" {{($usuario->assinatura_id['assinatura'] == 'K') ? 'selected' : '' }}>K9</option>
                                        <option value="F" {{($usuario->assinatura_id['assinatura'] == 'F') ? 'selected' : '' }}>Famali</option>
                                    </select>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                @endif --}}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password_confirm">Senha Confirmação</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Senha de Confirmação">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                <!-- Dados Pessoais -- FIM -->

                {{-- <div class="row">
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
                </div> --}}
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

    <script src="{{asset('nazox/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/lightbox.init.js')}}"></script>

    <script>
		$(document).ready(function(){
			$('.mask_cep').inputmask('99.999-999');
            $('.mask_cpf').inputmask('999.999.999-99');
            $('.mask_ddd').inputmask('(99)');
            $('.mask_telefone').inputmask('(99999-9999)');
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
            $('.dynamic_perfil').change(function(){

                if ($(this).val() != ''){
                    var perfil = $('#perfil').val();
                    var assinatura = $('#assinatura').val();

                    if(perfil == 1){
                        $('#assinatura').val('G');
                    } else {
                        if(assinatura != 'G'){
                            $('#assinatura').val(assinatura);
                        } else{
                            $('#assinatura').val('');
                        }
                    }
                }
            });
        });

        $(document).ready(function(){
            $('.dynamic_assinatura').change(function(){

                if ($(this).val() != ''){
                    var assinatura = $('#assinatura').val();
                    var perfil = $('#perfil').val();

                    if(assinatura == 'G'){
                        $('#perfil').val(1);
                    } else {
                        if(perfil != 1){
                            $('#perfil').val(perfil);
                        } else{
                            $('#perfil').val('');
                        }
                    }
            }
            });
        });
    </script>

@endsection

@section('head-css')
    <link href="{{asset('nazox/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endsection
