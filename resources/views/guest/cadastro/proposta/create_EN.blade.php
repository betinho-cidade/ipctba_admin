<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Motion Form | FAFIS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Motion Form | FAFIS" name="description" />
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

                       <form id="create_proposta" name="create_proposta" action="{{ route('proposta.store') }}" method="post"  class="needs-validation" novalidate>
                       @csrf
                       <input type="hidden" name="idioma" id="idioma" value="{{ $idioma }}">

                        <div class="row largura-div" style="padding: 0 10%;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="titulos" style="text-align: center;padding: 10px 3%;">
                                            <h3>Motion Form</h3>
                                            <h4 style="color:#575757;">International Apostolic Schoenstatt Family Federation</h4>
                                            <p>Every member of the Family Federation is entitled to submit motions and suggestions to the General Chapter, either individually or together with other members. Motions must be submitted in at least 3 languages (English, German and Spanish) by April 8, 2021.</p>
                                        </div>
                                        <div id="progrss-wizard" class="twitter-bs-wizard">
                                            <ul class="twitter-bs-wizard-nav nav-justified">
                                                <li class="nav-item">
                                                    <a href="#passo_EN" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">01</span>
                                                        <span class="step-title">ANSWER IN ENGLISH</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#passo_DE" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">02</span>
                                                        <span class="step-title">ANSWER IN GERMAN</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#passo_ES" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">03</span>
                                                        <span class="step-title">ANSWER IN SPANISH</span>
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
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="paise_EN">Territory</label>
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
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label for="autor_EN">Author(s)</label>
                                                                <input type="text" class="form-control" id="autor_EN" name="autor_EN" value="{{ old('autor_EN') }}" required>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="data_EN">Date</label>
                                                                  <input type="date" class="form-control" id="data_EN" name="data_EN" value="{{ old('data_EN') }}" required>
                                                                  <div class="valid-feedback">ok!</div>
                                                                  <div class="invalid-feedback">Invalid!</div>
															</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="titulo_EN">Title</label>
                                                                <textarea name="titulo_EN" id="titulo_EN" class="form-control" rows="3"
                                                                    required>{{ old('titulo_EN') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="texto_EN">Text</label>
                                                                <textarea name="texto_EN" id="texto_EN" class="form-control" rows="3"
                                                                    required>{{ old('texto_EN') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fundamentacao_EN">Justification</label>
                                                                <textarea name="fundamentacao_EN" id="fundamentacao_EN" class="form-control" rows="3"
                                                                    required>{{ old('fundamentacao_EN') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="comentario_EN">Comments</label>
                                                                <textarea name="comentario_EN" id="comentario_EN" class="form-control" rows="3"
                                                                    required>{{ old('comentario_EN') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="email_EN">E-mail</label>
                                                                <input type="text" class="form-control" id="email_EN" name="email_EN" value="{{ old('email_EN') }}" required>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="next"><a href="#" style="background-color: #000;">Próximo</a></li>
                                                    </ul>
                                                </div>

                                                <div class="tab-pane" id="passo_DE">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="paise_DE">Territory</label>
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
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label for="autor_DE">Author(s)</label>
                                                                <input type="text" class="form-control" id="autor_DE" name="autor_DE" value="{{ old('autor_DE') }}" required>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="data_DE">Date</label>
                                                                  <input type="date" class="form-control" id="data_DE" name="data_DE" value="{{ old('data_DE') }}" required>
                                                                  <div class="valid-feedback">ok!</div>
                                                                  <div class="invalid-feedback">Invalid!</div>
															</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="titulo_DE">Title</label>
                                                                <textarea name="titulo_DE" id="titulo_DE" class="form-control" rows="3"
                                                                    required>{{ old('titulo_DE') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="texto_DE">Text</label>
                                                                <textarea name="texto_DE" id="texto_DE" class="form-control" rows="3"
                                                                    required>{{ old('texto_DE') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fundamentacao_DE">Justification</label>
                                                                <textarea name="fundamentacao_DE" id="fundamentacao_DE" class="form-control" rows="3"
                                                                    required>{{ old('fundamentacao_DE') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="comentario_DE">Comments</label>
                                                                <textarea name="comentario_DE" id="comentario_DE" class="form-control" rows="3"
                                                                    required>{{ old('comentario_DE') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="email_DE">E-mail</label>
                                                                <input type="text" class="form-control" id="email_DE" name="email_DE" value="{{ old('email_DE') }}" required>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="#" style="background-color: #000;">Anterior</a></li>
                                                        <li class="next"><a href="#" style="background-color: #000;">Próximo</a></li>
                                                    </ul>
                                                </div>

                                                <div class="tab-pane" id="passo_ES">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="paise_ES">Territory</label>
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
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label for="autor_ES">Author(s)</label>
                                                                <input type="text" class="form-control" id="autor_ES" name="autor_ES" value="{{ old('autor_ES') }}" required>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="data_ES">Date</label>
                                                                  <input type="date" class="form-control" id="data_ES" name="data_ES" value="{{ old('data_ES') }}" required>
                                                                  <div class="valid-feedback">ok!</div>
                                                                  <div class="invalid-feedback">Invalid!</div>
															</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="titulo_ES">Title</label>
                                                                <textarea name="titulo_ES" id="titulo_ES" class="form-control" rows="3"
                                                                    required>{{ old('titulo_ES') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="texto_ES">Text</label>
                                                                <textarea name="texto_ES" id="texto_ES" class="form-control" rows="3"
                                                                    required>{{ old('texto_ES') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fundamentacao_ES">Justification</label>
                                                                <textarea name="fundamentacao_ES" id="fundamentacao_ES" class="form-control" rows="3"
                                                                    required>{{ old('fundamentacao_ES') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="comentario_ES">Comments</label>
                                                                <textarea name="comentario_ES" id="comentario_ES" class="form-control" rows="3"
                                                                    required>{{ old('comentario_ES') }}</textarea>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="email_ES">E-mail</label>
                                                                <input type="text" class="form-control" id="email_ES" name="email_ES" value="{{ old('email_ES') }}" required>
                                                                <div class="valid-feedback">ok!</div>
                                                                <div class="invalid-feedback">Invalid!</div>
                                                            </div>
                                                        </div>
                                                    </div>
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

