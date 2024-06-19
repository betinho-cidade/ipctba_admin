    <!doctype html>
    <html lang="en">

        <head>

            <meta charset="utf-8" />
            <title>IPCTBA | Igreja Presbiteriana de Curitiba</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="IPCTBA - Igreja Presbiteriana de Curitiba" name="description" />
            <meta content="IPCTBA" name="IPCTBA" />
            <!-- App favicon -->
            <link rel="shortcut icon" href="assets/images/favicon.ico">

            <!-- Bootstrap Css -->
            <link href="{{asset('nazox/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
            <!-- Icons Css -->
            <link href="{{asset('nazox/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
            <!-- App Css-->
            <link href="{{asset('nazox/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
            <!-- Cityinbag - CSS -->
            <link href="{{asset('css/cityinbag.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        </head>

        <body data-sidebar="dark">

            <!-- Begin page -->
            <div id="layout-wrapper">

                <header id="page-topbar">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <!-- LOGO -->
                            <div class="navbar-brand-box">
                                <a class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="{{asset('nazox/assets/images/logo-sm-dark.png')}}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{asset('nazox/assets/images/logo-dark.png')}}" alt="" height="20">
                                    </span>
                                </a>

                                <a class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{asset('nazox/assets/images/logo-sm-light.png')}}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{asset('nazox/assets/images/logo-light.png')}}" alt="" height="36">
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                </header>

                <!-- ========== Left Sidebar Start ========== -->
                <div class="vertical-menu">

                    <div data-simplebar class="h-100">

                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <!-- Left Menu Start -->
                            <ul class="metismenu list-unstyled" id="side-menu">
                                <li>
                                    <a href="index.html" class="waves-effect" style="cursor: default;color: #ffffff;pointer-events: none;">
                                        <i class="ri-lock-line" style="color: #ffffff;"></i><span class="badge badge-pill badge-success float-right"></span>
                                        <span>Ficha de Visitante</span>
                                    </a>
                                </li>
                                <li>
                                    <a style="padding: .625rem 1rem;  color: #b7b7b7;cursor: default;pointer-events: none;">
                                        <span><p>É BOM TER VOCÊ AQUI CONOSCO!</p> Para podermos abençoar sua vida, por gentileza, preencha o formulário ao lado e aguarde o contato de um dos nossos responsáveis.</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <!-- Sidebar -->
                    </div>
                </div>
                <!-- Left Sidebar End -->


                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">
                        <div class="container-fluid">
                        <!-- CADASTRO DE NOVO USUARIO - INI -->

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">IPCTBA - Igreja Presbiteriana de Curitiba</h4>
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

                <h4 class="card-title">Ficha do Visitante</h4>
                <p class="card-title-desc">É BOM TER VOCÊ AQUI CONOSCO!</p>
                <form name="create_ficha_visitante" method="POST" action="{{route('ficha_visitante.store')}}"  class="needs-validation"  novalidate>
                    @csrf

                    <!-- Dados Pessoais - INI -->
                    <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                        <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                    </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" required>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_visitante">E-mail</label>
                                    <input type="email" class="form-control" id="email_visitante" name="email_visitante" value="{{old('email_visitante')}}">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="celular">Telefone Celular</label>
                                <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{old('celular')}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="data_nascimento">Data Nascimento</label>
                                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{old('data_nascimento')}}">
                            </div>     
                            <div class="col-md-4">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" name="sexo" class="form-control">
                                    <option value="">---</option>
                                    <option value="M" {{(old('sexo') == 'M') ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{(old('sexo') == 'F') ? 'selected' : '' }}>Feminino</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <p></p>
                    <!-- Dados Pessoais - FIM -->

                        <div class="row">
                            <div class="col-md-8">
                                <label for="igreja_frequenta">Igreja que Frequenta</label>
                                <input type="text" class="form-control" id="igreja_frequenta" name="igreja_frequenta" value="{{old('igreja_frequenta')}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="igreja_cidade">Cidade/UF</label>
                                <input type="text" name="igreja_cidade" id="igreja_cidade" class="form-control" value="{{old('igreja_cidade')}}">
                            </div>                            
                        </div>

                    <!-- Dados Endereço - INI -->
                    <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;margin-top:10px;">
                        <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Endereço</h5>
                    </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="end_cep">CEP</label>
                                <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                                <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{old('end_cep')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="end_cidade">Cidade</label>
                                <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{old('end_cidade')}}">
                            </div>

                            <div class="col-md-2">
                                <label for="end_uf">Estado</label>
                                <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{old('end_uf')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="end_bairro">Bairro</label>
                                <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{old('end_bairro')}}">
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="end_endereco">Endereço</label>
                                <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{old('end_logradouro')}}">
                            </div>

                            <div class="col-md-2">
                                <label for="end_numero">Número</label>
                                <input type="text" name="end_numero" id="end_numero" value="{{old('end_numero')}}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label for="end_complemento">Complemento </label>
                                <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{old('end_complemento')}}">
                            </div>
                        </div>
                        <p></p>
                    <!-- Dados Endereço - FIM -->

                    <div class="bg-soft-primary p-3 rounded" style="margin-bottom:20px;margin-top:10px;">
                        <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Como poderíamos abençoar sua vida. Você gostaria de:</h5>
                    </div>

                    <div class="row">
                        @foreach($solicitacao_visitantes as $solicitacao_visitante)
                        <div class="col-md-12" style="">
                            <div class="form-check mb-1 " style="margin-bottom:15px !important;">
                                <input class="form-check-input" type="checkbox" id="solicitacao_{{$solicitacao_visitante->id}}" name="solicitacao_{{$solicitacao_visitante->id}}">
                                    <label class="form-check-label" styçe="margin-top: 1px;' for="{{$solicitacao_visitante->id}}">
                                        {{$solicitacao_visitante->nome}}
                                    </label>
                                    @if($solicitacao_visitante->informar_motivo=='S')
                                    <br/>
                                        <label class="form-check-label left" for="{{$solicitacao_visitante->id}}">
                                            <textarea  style="margin-left: 0;  margin-top: 5px;width: 400px;" name="informar_motivo_{{$solicitacao_visitante->id}}" id="informar_motivo_{{$solicitacao_visitante->id}}" class="form-control" placeholder="Informar Motivo"></textarea>
                                        </label>
                                    @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                                        

                            <div class="row" style="margin-top:20px;">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox ">
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


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    2014-<script>document.write(new Date().getFullYear())</script> © Cityinbag.
                </div>
            </div>
        </div>
    </footer>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="http://localhost:8000/nazox/assets/libs/jquery/jquery.min.js"></script>
    <script src="http://localhost:8000/nazox/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost:8000/nazox/assets/libs/metismenu/metisMenu.min.js"></script>

    <script src="http://localhost:8000/nazox/assets/js/app.js"></script>
    <script src="http://localhost:8000/nazox/assets/js/pages/form-validation.init.js"></script>
    <script src="http://localhost:8000/nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="http://localhost:8000/nazox/assets/js/pages/form-element.init.js"></script>
    <script src="http://localhost:8000/nazox/assets/libs/select2/js/select2.min.js"></script>
    <!-- form mask -->
    <script src="http://localhost:8000/nazox/assets/libs/inputmask/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.mask_cep').inputmask('99.999-999');
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
                        url: "{{route('ficha_visitante.js_viacep')}}",
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

    </body>
    </html>

