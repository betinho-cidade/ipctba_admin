<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Capitular Profile Form | FAFIS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Capitular Profile Form | FAFIS" name="description" />
        <meta content="Cityinbag" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

        <!-- twitter-bootstrap-wizard css -->
        <link rel="stylesheet" href="{{asset('nazox/assets/libs/twitter-bootstrap-wizard/prettify.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('nazox/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('nazox/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('nazox/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Cityinbag Css -->
        <link href="{{asset('css/cityinbag.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

        <meta name="facebook-domain-verification" content="3bhilqcanl79lusncojvpqsknbf2p3" />
    </head>


    <body data-sidebar="dark" style="background-size: cover !important;background: url({{asset('images/bac.jpg')}}) left top no-repeat;">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content" style="margin-left: 0;">

                <div class="page-content" style="padding: calc(1% + 24px) calc(24px / 2) 60px calc(24px / 2);">
                    <div class="container-fluid">
                        <div class="row" style="padding: 0 10%;">
                            <div class="col-12" style="text-align: center;    margin-bottom: 20px;">
                                <img src="{{ asset('images/logo-B-1.png') }}">
                            </div>
                        </div>

                        <!-- TABS -- INI -->
                       <form id="create_capitular" name="create_capitular" action="{{ route('capitular.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="needs-validation" novalidate>
                       @csrf
                       <input type="hidden" name="idioma" id="idioma" value="{{ $idioma }}">

                        <div class="row largura-div" style="padding: 0 10%;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="titulos" style="text-align: center;padding: 10px 3%;">
                                            <h3>Capitular Profile Form</h3>
                                            <h4 style="color:#575757;">W Kapitule Generalnej Uczestniczą Następujące Osoby:</h4>
                                            <p>Członkowie Międzynarodowego Kierownictwa - Rodziny Krajowe autonomicznych terytorialnych wspólnot Związku - Rodziny delegatów wybrane przez autonomiczne wspólnoty terytorialne Związku (1 para na terytorium).</p>
                                            <p>Na zaproszenie Międzynarodowego Kierownictwa w kapitule mogą uczestniczyć również małżeństwa z terytoriów, które są w trakcie zakładania, jak również małżeństwo, które stało na czele Międzynarodowego Kierownictwa w poprzedniej kadencji. Osoby te mają prawo zabierać głos, ale nie mogą głosować. W 2021 roku następujące terytoria będą reprezentowane przez jedno małżeństwo: Kostaryka, Ekwador, Meksyk, Czechy i Węgry. Oprócz uczestników kapituły będą zaangażowane inne osoby jako pracownicy i wolontariusze: sekretarze, pomoc techniczna, tłumacze, personel domowy itp. Nazwiska członków kapituły zostaną opublikowane w późniejszym terminie w tym miejscu.</p>
                                        </div>
                                        <div id="progrss-wizard" class="twitter-bs-wizard">
                                            <ul class="twitter-bs-wizard-nav nav-justified">
                                                <li class="nav-item">
                                                    <a href="#passo_EN" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">01</span>
                                                        <span class="step-title">ODPOWIEDZ PO ANGIELSKU</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#passo_DE" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">02</span>
                                                        <span class="step-title">ODPOWIEDZ PO NIEMIECKU</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#passo_ES" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">03</span>
                                                        <span class="step-title">ODPOWIEDZ W JĘZYKU HISZPAŃSKIM</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div id="bar" class="progress mt-4">
                                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
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

                                            <div class="tab-content twitter-bs-wizard-tab-content">
                                                <div class="tab-pane" id="passo_EN">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="paise_EN">TERYTORIUM</label>
                                                                <select id="paise_EN" name="paise_EN" class="form-control" required>
                                                                    <option value="">---</option>
                                                                    @foreach($paises as $paise)
                                                                        <option value="{{$paise->id}}" {{($paise->id == old('paise_EN')) ? 'selected' : '' }}>{{$paise->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY OBOJE</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nome_EN">NAZWISKA</label>
                                                                    <textarea name="nome_EN" id="nome_EN" class="form-control" rows="3"
                                                                        required>{{ old('nome_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="celular_EN">MOBILE PHONES (WHATSAPP)</label>
                                                                    <textarea name="celular_EN" id="celular_EN" class="form-control" rows="3"
                                                                        required>{{ old('celular_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="data_nascimento_EN">DATY URODZENIA</label>
                                                                    <textarea name="data_nascimento_EN" id="data_nascimento_EN" class="form-control" rows="3"
                                                                        required>{{ old('data_nascimento_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="profissao_EN">ZAWÓD</label>
                                                                    <textarea name="profissao_EN" id="profissao_EN" class="form-control" rows="3"
                                                                        required>{{ old('profissao_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="idioma_EN">ZNAJOMOŚĆ OBCYCH JĘZYKÓW</label>
                                                                    <textarea name="idioma_EN" id="idioma_EN" class="form-control" rows="3"
                                                                        required>{{ old('idioma_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY JAKO RODZINA</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="data_casamento_EN">DATA SLUBU</label>
                                                                    <textarea name="data_casamento_EN" id="data_casamento_EN" class="form-control" rows="3"
                                                                        required>{{ old('data_casamento_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="filho_EN">DZIECI (IMIONA, WIEK)</label>
                                                                    <textarea name="filho_EN" id="filho_EN" class="form-control" rows="3"
                                                                        required>{{ old('filho_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="endereco_EN">ADRES</label>
                                                                    <textarea name="endereco_EN" id="endereco_EN" class="form-control" rows="3"
                                                                        required>{{ old('endereco_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email_EN">ADRES MAILOWY</label>
                                                                    <textarea name="email_EN" id="email_EN" class="form-control" rows="3"
                                                                        required>{{ old('email_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="path_familia_01_EN">Rodzinne zdjęcie - 01</label>
                                                                <div class="form-group custom-file">
                                                                    <input type="file" class="custom-file-input" id="path_familia_01_EN" name="path_familia_01_EN" accept="image/*" required>
                                                                    <label class="custom-file-label" for="path_familia_01_EN"></label>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="path_familia_02_EN">Rodzinne zdjęcie - 02</label>
                                                                <div class="form-group custom-file">
                                                                    <input type="file" class="custom-file-input" id="path_familia_02_EN" name="path_familia_02_EN" accept="image/*">
                                                                    <label class="custom-file-label" for="path_familia_02_EN"></label>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="path_familia_03_EN">Rodzinne zdjęcie - 03</label>
                                                                <div class="form-group custom-file">
                                                                    <input type="file" class="custom-file-input" id="path_familia_03_EN" name="path_familia_03_EN" accept="image/*">
                                                                    <label class="custom-file-label" for="path_familia_03_EN"></label>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY W SZENSZTACIE</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="data_uniao_familia_EN">OD KIEDY W ZWIĄZKU RODZIN ?</label>
                                                                    <textarea name="data_uniao_familia_EN" id="data_uniao_familia_EN" class="form-control" rows="3"
                                                                        required>{{ old('data_uniao_familia_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="curso_EN">KURS</label>
                                                                    <textarea name="curso_EN" id="curso_EN" class="form-control" rows="3"
                                                                        required>{{ old('curso_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ideal_curso_EN">COURSE IDEAL</label>
                                                                    <textarea name="ideal_curso_EN" id="ideal_curso_EN" class="form-control" rows="3"
                                                                        required>{{ old('ideal_curso_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ano_consagracao_EN">ROK POŚWIĘCENIA WIECZYSTEGO</label>
                                                                    <textarea name="ano_consagracao_EN" id="ano_consagracao_EN" class="form-control" rows="3"
                                                                        required>{{ old('ano_consagracao_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="santuario_EN">DOMOWE SANKTUARIUM</label>
                                                                    <textarea name="santuario_EN" id="santuario_EN" class="form-control" rows="3"
                                                                        required>{{ old('santuario_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="apostolado_EN">APOSTOLAT</label>
                                                                    <textarea name="apostolado_EN" id="apostolado_EN" class="form-control" rows="3"
                                                                        required>{{ old('apostolado_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="desejo_casal_EN">NASZE PRAGNIENIA JAKO MAŁŻEŃSTWA</label>
                                                                    <textarea name="desejo_casal_EN" id="desejo_casal_EN" class="form-control" rows="3"
                                                                        required>{{ old('desejo_casal_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="palavra_EN">TRZY SŁOWA, KTGÓRE NAS OKREŚLAJĄ</label>
                                                                    <textarea name="palavra_EN" id="palavra_EN" class="form-control" rows="3"
                                                                        required>{{ old('palavra_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="frase_EN">INSPIRUJĄCA NAS SENTENCJA</label>
                                                                    <textarea name="frase_EN" id="frase_EN" class="form-control" rows="3"
                                                                        required>{{ old('frase_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="expectativa_EN">NASZE OCZEKIWANIA WOBEC KAPITUŁY</label>
                                                                    <textarea name="expectativa_EN" id="expectativa_EN" class="form-control" rows="3"
                                                                        required>{{ old('expectativa_EN') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="next"><a href="#" style="background-color: #000;">Próximo</a></li>
                                                    </ul>
                                                </div>

                                                <div class="tab-pane" id="passo_DE">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="paise_DE">TERYTORIUM</label>
                                                                <select id="paise_DE" name="paise_DE" class="form-control" required>
                                                                    <option value="">---</option>
                                                                    @foreach($paises as $paise)
                                                                        <option value="{{$paise->id}}" {{($paise->id == old('paise_DE')) ? 'selected' : '' }}>{{$paise->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY OBOJE
</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nome_DE">NAZWISKA</label>
                                                                    <textarea name="nome_DE" id="nome_DE" class="form-control" rows="3"
                                                                        required>{{ old('nome_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="celular_DE">MOBILE PHONES (WHATSAPP)</label>
                                                                    <textarea name="celular_DE" id="celular_DE" class="form-control" rows="3"
                                                                        required>{{ old('celular_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="data_nascimento_EN">DATY URODZENIA</label>
                                                                    <textarea name="data_nascimento_DE" id="data_nascimento_DE" class="form-control" rows="3"
                                                                        required>{{ old('data_nascimento_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="profissao_DE">ZAWÓD</label>
                                                                    <textarea name="profissao_DE" id="profissao_DE" class="form-control" rows="3"
                                                                        required>{{ old('profissao_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="idioma_DE">ZNAJOMOŚĆ OBCYCH JĘZYKÓW</label>
                                                                    <textarea name="idioma_DE" id="idioma_DE" class="form-control" rows="3"
                                                                        required>{{ old('idioma_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY JAKO RODZINA</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="data_casamento_DE">DATA SLUBU</label>
                                                                    <textarea name="data_casamento_DE" id="data_casamento_DE" class="form-control" rows="3"
                                                                        required>{{ old('data_casamento_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="filho_DE">DZIECI (IMIONA, WIEK)</label>
                                                                    <textarea name="filho_DE" id="filho_DE" class="form-control" rows="3"
                                                                        required>{{ old('filho_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="endereco_DE">ADRES</label>
                                                                    <textarea name="endereco_DE" id="endereco_DE" class="form-control" rows="3"
                                                                        required>{{ old('endereco_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email_DE">ADRES MAILOWY</label>
                                                                    <textarea name="email_DE" id="email_DE" class="form-control" rows="3"
                                                                        required>{{ old('email_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY W SZENSZTACIE</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="data_uniao_familia_DE">OD KIEDY W ZWIĄZKU RODZIN ?</label>
                                                                    <textarea name="data_uniao_familia_DE" id="data_uniao_familia_DE" class="form-control" rows="3"
                                                                        required>{{ old('data_uniao_familia_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="curso_DE">KURS</label>
                                                                    <textarea name="curso_DE" id="curso_DE" class="form-control" rows="3"
                                                                        required>{{ old('curso_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ideal_curso_DE">COURSE IDEAL</label>
                                                                    <textarea name="ideal_curso_DE" id="ideal_curso_DE" class="form-control" rows="3"
                                                                        required>{{ old('ideal_curso_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ano_consagracao_DE">ROK POŚWIĘCENIA WIECZYSTEGO</label>
                                                                    <textarea name="ano_consagracao_DE" id="ano_consagracao_DE" class="form-control" rows="3"
                                                                        required>{{ old('ano_consagracao_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="santuario_DE">DOMOWE SANKTUARIUM</label>
                                                                    <textarea name="santuario_DE" id="santuario_DE" class="form-control" rows="3"
                                                                        required>{{ old('santuario_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="apostolado_DE">APOSTOLAT</label>
                                                                    <textarea name="apostolado_DE" id="apostolado_DE" class="form-control" rows="3"
                                                                        required>{{ old('apostolado_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="desejo_casal_DE">NASZE PRAGNIENIA JAKO MAŁŻEŃSTWA</label>
                                                                    <textarea name="desejo_casal_DE" id="desejo_casal_DE" class="form-control" rows="3"
                                                                        required>{{ old('desejo_casal_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="palavra_DE">TRZY SŁOWA, KTGÓRE NAS OKREŚLAJĄ</label>
                                                                    <textarea name="palavra_DE" id="palavra_DE" class="form-control" rows="3"
                                                                        required>{{ old('palavra_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="frase_DE">INSPIRUJĄCA NAS SENTENCJA</label>
                                                                    <textarea name="frase_DE" id="frase_DE" class="form-control" rows="3"
                                                                        required>{{ old('frase_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="expectativa_DE">NASZE OCZEKIWANIA WOBEC KAPITUŁY</label>
                                                                    <textarea name="expectativa_DE" id="expectativa_DE" class="form-control" rows="3"
                                                                        required>{{ old('expectativa_DE') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="#" style="background-color: #000;">Anterior</a></li>
                                                        <li class="next"><a href="#" style="background-color: #000;">Próximo</a></li>
                                                    </ul>
                                                </div>

                                                <div class="tab-pane" id="passo_ES">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="paise_ES">TERYTORIUM</label>
                                                                <select id="paise_ES" name="paise_ES" class="form-control" required>
                                                                    <option value="">---</option>
                                                                    @foreach($paises as $paise)
                                                                        <option value="{{$paise->id}}" {{($paise->id == old('paise_ES')) ? 'selected' : '' }}>{{$paise->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY OBOJE
</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nome_ES">NAZWISKA</label>
                                                                    <textarea name="nome_ES" id="nome_ES" class="form-control" rows="3"
                                                                        required>{{ old('nome_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="celular_ES">MOBILE PHONES (WHATSAPP)</label>
                                                                    <textarea name="celular_ES" id="celular_ES" class="form-control" rows="3"
                                                                        required>{{ old('celular_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="data_nascimento_EN">DATY URODZENIA</label>
                                                                    <textarea name="data_nascimento_ES" id="data_nascimento_ES" class="form-control" rows="3"
                                                                        required>{{ old('data_nascimento_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="profissao_ES">ZAWÓD</label>
                                                                    <textarea name="profissao_ES" id="profissao_ES" class="form-control" rows="3"
                                                                        required>{{ old('profissao_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="idioma_ES">ZNAJOMOŚĆ OBCYCH JĘZYKÓW</label>
                                                                    <textarea name="idioma_ES" id="idioma_ES" class="form-control" rows="3"
                                                                        required>{{ old('idioma_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY JAKO RODZINA</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="data_casamento_ES">DATA SLUBU</label>
                                                                    <textarea name="data_casamento_ES" id="data_casamento_ES" class="form-control" rows="3"
                                                                        required>{{ old('data_casamento_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="filho_ES">DZIECI (IMIONA, WIEK)</label>
                                                                    <textarea name="filho_ES" id="filho_ES" class="form-control" rows="3"
                                                                        required>{{ old('filho_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="endereco_ES">ADRES</label>
                                                                    <textarea name="endereco_ES" id="endereco_ES" class="form-control" rows="3"
                                                                        required>{{ old('endereco_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email_ES">ADRES MAILOWY</label>
                                                                    <textarea name="email_ES" id="email_ES" class="form-control" rows="3"
                                                                        required>{{ old('email_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <p></p>

                                                    <fieldset class="border p-2">
                                                        <legend class="w-auto">MY W SZENSZTACIE</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="data_uniao_familia_ES">OD KIEDY W ZWIĄZKU RODZIN ?</label>
                                                                    <textarea name="data_uniao_familia_ES" id="data_uniao_familia_ES" class="form-control" rows="3"
                                                                        required>{{ old('data_uniao_familia_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="curso_ES">KURS</label>
                                                                    <textarea name="curso_ES" id="curso_ES" class="form-control" rows="3"
                                                                        required>{{ old('curso_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ideal_curso_ES">COURSE IDEAL</label>
                                                                    <textarea name="ideal_curso_ES" id="ideal_curso_ES" class="form-control" rows="3"
                                                                        required>{{ old('ideal_curso_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ano_consagracao_ES">ROK POŚWIĘCENIA WIECZYSTEGO</label>
                                                                    <textarea name="ano_consagracao_ES" id="ano_consagracao_ES" class="form-control" rows="3"
                                                                        required>{{ old('ano_consagracao_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="santuario_ES">DOMOWE SANKTUARIUM</label>
                                                                    <textarea name="santuario_ES" id="santuario_ES" class="form-control" rows="3"
                                                                        required>{{ old('santuario_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="apostolado_ES">APOSTOLAT</label>
                                                                    <textarea name="apostolado_ES" id="apostolado_ES" class="form-control" rows="3"
                                                                        required>{{ old('apostolado_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="desejo_casal_ES">NASZE PRAGNIENIA JAKO MAŁŻEŃSTWA</label>
                                                                    <textarea name="desejo_casal_ES" id="desejo_casal_ES" class="form-control" rows="3"
                                                                        required>{{ old('desejo_casal_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="palavra_ES">TRZY SŁOWA, KTGÓRE NAS OKREŚLAJĄ</label>
                                                                    <textarea name="palavra_ES" id="palavra_ES" class="form-control" rows="3"
                                                                        required>{{ old('palavra_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="frase_ES">INSPIRUJĄCA NAS SENTENCJA</label>
                                                                    <textarea name="frase_ES" id="frase_ES" class="form-control" rows="3"
                                                                        required>{{ old('frase_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="expectativa_ES">NASZE OCZEKIWANIA WOBEC KAPITUŁY</label>
                                                                    <textarea name="expectativa_ES" id="expectativa_ES" class="form-control" rows="3"
                                                                        required>{{ old('expectativa_ES') }}</textarea>
                                                                    <div class="valid-feedback">ok!</div>
                                                                    <div class="invalid-feedback">Invalid!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="#" style="background-color: #000;">Anterior</a></li>
                                                        <button data-toggle="validar" id="btn_create_solicitacao" type="submit" class="btn float-right" style="color: white;background-color: #000;">Enviar Solicitação</button>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </form>

                        <!-- TABS -- FIM -->


                    </div>
                </div>

                <footer class="footer" style="left: 0;display:none;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-sm-center d-none d-sm-block">
                                    <a href="mailto:cadastro@metaprev.com.br" style="color: #505d69;font-size: 16px;"><i class="mdi mdi-email-open-outline" style="color: #000;"></i> cadastro@metaprev.com.br</a><span style="margin-right: 30px;"></span>

                                    <a href="tel:(43) 3337-2426" style="color: #505d69;font-size: 16px;"><i class="mdi mdi-cellphone-android" style="color: #000;"></i> (43) 3337-2426</a><span style="margin-right: 30px;"></span>

                                    <a href="http://api.whatsapp.com/send?1=pt_BR&phone=5543996748620" style="color: #505d69;font-size: 16px;"><i class="mdi mdi-whatsapp" style="color: #000;"></i> (43) 99674-8620</a><span style="margin-right: 30px;"></span>

                                    <a href="https://www.facebook.com/metaprev/" target="_blank" style="font-size: 20px;"><i class="mdi mdi-facebook" style="color: #000;"></i> <span style="margin-right: 10px;"></span>

                                    <a href="https://metaprevcadastro.com.br/metaprevauxiliomaternidade" target="_blank" style="font-size: 20px;"><i class="mdi mdi-instagram" style="color: #000;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('nazox/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>

        <script src="{{ asset('nazox/assets/js/pages/form-validation.init.js') }}"></script>
        <script src="{{ asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script src="{{ asset('nazox/assets/js/pages/form-element.init.js') }}"></script>

        <!-- twitter-bootstrap-wizard js -->
        <script src="{{asset('nazox/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

        <script src="{{asset('nazox/assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

        <!-- form wizard init -->
        <script src="{{asset('nazox/assets/js/pages/form-wizard.init.js')}}"></script>

        <!-- form mask -->
        <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>

        <script src="{{asset('nazox/assets/js/app.js')}}"></script>

        <script>

            $(document).ready(function() {
                $('button[data-toggle="validar"]').click(function() {

                    const forms = document.querySelectorAll('.needs-validation');

                    Array.prototype.slice.call(forms).forEach((form) => {
                        form.addEventListener('submit', (event) => {

                         var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
                         $('.nav a[href="#' + id + '"]').tab('show');

                        }, false);
                      });
                });
            });

        </script>

    </body>
</html>

