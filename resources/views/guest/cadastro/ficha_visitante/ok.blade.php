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
                                <span><p>É BOM TER VOCÊ AQUI CONOSCO!</p> Sua ficha foi finalizada. Por gentileza, aguarde o contato de um dos nossos responsáveis.</span>
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


                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Criação da Ficha de Visitante - REALIZADA COM SUCESSO</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <!-- FORMULÁRIO - INICIO -->

                                    <h4 class="card-title">Formulário de Solicitação da Ficha de Visitante - ENVIADA</h4>
                                    <p class="card-title-desc">A solicitação foi enviada para nossa equipe de análise. Agradecemos o preenchimento.</p>

                                    <!-- FORMULÁRIO - FIM -->
                                    </div>
                                </div>
                            </div>
                        </div>

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


        </body>
        </html>

