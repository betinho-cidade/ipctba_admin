<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Formulário Propostas | FAFIS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Formulário Propostas | FAFIS" name="description" />
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

                        <div class="row largura-div" style="padding: 0 10%;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body" style="padding: 8% 0;">
                                        <div class="titulos" style="text-align: center;padding: 10px 5%;">
                                            <h3>Success!</h3>
                                            <h4>Thank you for your message, your form was submitted successfully.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



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

