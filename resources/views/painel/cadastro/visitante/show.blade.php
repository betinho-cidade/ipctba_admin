@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box align-items-center justify-content-between">
            <h4 class="mb-0">Informações da Ficha do Visitante
                <span class="float-right" style="background: #323232; padding: 10px 20px; margin-top: -8px; border-radius: 5px; color: #fff; font-size: 13px; font-weight: 500;"> Solicitação em: {{$visitante->data_solicitacao}}</span>
            </h4>
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

            <h4 class="card-title">Formulário de Solicitação da Ficha de Visitante - Atualização das Informações <span class="float-right {{ ($visitante->status == 'FL' ? 'bg-success' : 'bg-warning') }}" style="color: #ffffff; padding: 6px 13px; font-size: 21px; border-radius: 5px;">&nbsp;{{ $visitante->status_texto }}&nbsp;</span></h4>
            <p class="card-title-desc">A solicitação de atualização de ficha cadastral será enviada aos responsáveis para análise e efetivação.</p>
            <form name="edit_visitante" method="POST" action="{{route('visitante.update', compact('visitante'))}}"  class="needs-validation"  accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="lider">Líder responsável pelo preenchimento da Ficha de Visitante</label>
                                <select @if(!Gate::check('assign_ficha_visitante')) disabled @endif id="lider" name="lider" class="form-control">
                                    <option value="">---</option>
                                    @foreach($liders as $lider)
                                        <option value="{{$lider->id}}" {{($visitante->lider->id ?? -1 == $lider->id) ? 'selected' : '' }}>{{$lider->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="membro">Selecionar caso se torne Membro</label>
                                <select id="membro" name="membro" class="form-control">
                                    <option value="">---</option>
                                    @foreach($membros as $membro_lst)
                                        <option value="{{$membro_lst->id}}" {{($membro_lst->id == $visitante->membro_id) ? 'selected' : '' }}>{{$membro_lst->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao">Situação da Ficha</label>
                                <select id="situacao" name="situacao" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="AB" {{($visitante->status == 'AB') ? 'selected' : '' }}>Aberta Site</option>
                                    <option value="RL" {{($visitante->status == 'RL') ? 'selected' : '' }}>Repassada Líder</option>
                                    <option value="FL" {{($visitante->status == 'FL') ? 'selected' : '' }}>Finalizada Líder</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>         
                    
                    <div class="row espacamento" style=" display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: flex-end; align-items: center;margin-bottom:20px; padding-right: 20px;">
                        <label class="form-check-label float-right" for="RS" style="margin-right: 25px; font-weight: 800;  color: #000;">
                        Selecione a classificação do visitante
                        </label>
                        <ul style="margin-bottom: 0;">
                            <li style="float:left;margin-right: 50px;">
                                <input class="form-check-input float-right" type="radio" {{($visitante->tipo_visitante == 'RS') ? 'checked' : ''}} id="RS" name="tipo_visitante" value="RS">
                                <label class="form-check-label float-right" for="RS" style="margin-left: -3px;margin-top: 1px;">
                                    RESIDENTE
                                </label>
                            </li>
                            <li style="float:left;    margin-right: 50px;">
                            <input class="form-check-input float-right" type="radio" {{($visitante->tipo_visitante == 'EM') ? 'checked' : ''}} id="EM" name="tipo_visitante" value="EM">
                                <label class="form-check-label float-right" for="EM" style="margin-left: -3px;margin-top: 1px;">
                                    EM MUDANÇA
                                </label>
                            </li>
                            <li style="float:left; ">
                            <input class="form-check-input float-right" type="radio" {{($visitante->tipo_visitante == 'NR') ? 'checked' : ''}} id="NR" name="tipo_visitante" value="NR">
                                <label class="form-check-label float-right" for="NR" style="margin-left: -3px;margin-top: 1px;">
                                    NÃO RESIDENTE
                                </label>
                            </li>
                            
                        </ul>                                             
                    </div>           


                    <!-- Dados Pessoais - INI -->
                    <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                        <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                    </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{$visitante->nome}}" required>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_visitante">E-mail</label>
                                    <input type="email" class="form-control" id="email_visitante" name="email_visitante" value="{{$visitante->email_visitante}}">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="celular">Telefone Celular</label>
                                <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{$visitante->celular}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="data_nascimento">Data Nascimento</label>
                                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{$visitante->data_nascimento_ajustada}}">
                            </div>     
                            <div class="col-md-4">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" name="sexo" class="form-control">
                                    <option value="">---</option>
                                    <option value="M" {{($visitante->sexo == 'M') ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{($visitante->sexo == 'F') ? 'selected' : '' }}>Feminino</option>
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
                                <input type="text" class="form-control" id="igreja_frequenta" name="igreja_frequenta" value="{{$visitante->igreja_frequenta}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="igreja_cidade">Cidade/UF</label>
                                <input type="text" name="igreja_cidade" id="igreja_cidade" class="form-control" value="{{$visitante->igreja_cidade}}">
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
                                <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{$visitante->end_cep}}">
                            </div>

                            <div class="col-md-4">
                                <label for="end_cidade">Cidade</label>
                                <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{$visitante->end_cidade}}">
                            </div>

                            <div class="col-md-2">
                                <label for="end_uf">Estado</label>
                                <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{$visitante->end_uf}}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_bairro">Bairro</label>
                                <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{$visitante->end_bairro}}">
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="end_endereco">Endereço</label>
                                <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{$visitante->end_logradouro}}">
                            </div>

                            <div class="col-md-2">
                                <label for="end_numero">Número</label>
                                <input type="text" name="end_numero" id="end_numero" value="{{$visitante->end_numero}}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label for="end_complemento">Complemento </label>
                                <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{$visitante->end_complemento}}">
                            </div>
                        </div>
                        <p></p>
                    <!-- Dados Endereço - FIM -->


                @can('edit_ficha_visitante')
                    @if($visitante->status != 'FL')
                        <p></p>
                        <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
                    @endif
                @endcan
            </form>
            <!-- FORMULÁRIO - FIM -->

            @if($visitante->ficha_visitantes->count() > 0)
            <form name="edit_visitante_processo" method="POST" action="{{route('visitante.processos', compact('visitante'))}}"  class="needs-validation"  accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;margin-top:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Ações necessárias para finalização da Ficha</h5>
                </div>

                <div id="accordion" class="custom-accordion">
                @foreach($visitante->ficha_visitantes()->join('solicitacao_visitantes', 'ficha_visitantes.solicitacao_visitante_id', '=', 'solicitacao_visitantes.id')->orderBy('solicitacao_visitantes.origem', 'desc')->select('ficha_visitantes.*')->get() as $ficha_visitante)
                    <div class="card mb-1 shadow-none">
                        <span class="text-dark collapsed" data-bs-toggle="collapse"
                                                aria-expanded="false"
                                                aria-controls="accordion_{{$ficha_visitante->id}}">
                            <div class="card-header" id="heading_{{$ficha_visitante->id}}">
                                <h6 class="m-0">
                                    {{$ficha_visitante->solicitacao_visitante->nome}}
                                    @if($ficha_visitante->solicitacao_visitante->informar_motivo == 'S')
                                        <textarea disabled style="margin-top:5px;width:100%;padding: 10px;">{{$ficha_visitante->motivo}}</textarea>
                                    @endif
                                </h6>
                            </div>
                        </span>
            
                        <div id="accordion_{{$ficha_visitante->id}}" class="collapse show"
                                        aria-labelledby="heading_{{$ficha_visitante->id}}" data-bs-parent="#accordion">
                            <div class="card-body">
                                @foreach($ficha_visitante->solicitacao_visitante->processo_visitantes as $processo_visitante)
                                @php $ficha_processo = \App\Models\FichaVisitanteProcesso::where('ficha_visitante_id', $ficha_visitante->id)->where('processo_visitante_id', $processo_visitante->id)->first(); @endphp
                                <div class="row" style="display: flex; flex-direction: row; flex-wrap: nowrap; align-content: center; justify-content: center; align-items: center;    margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <div class="form-check mb-1 float-left">
                                            <input class="form-check-input float-left" type="checkbox" {{($ficha_processo) ? 'checked' : ''}} id="processo_{{$processo_visitante->id}}" name="processo_{{$processo_visitante->id}}">
                                            <label class="form-check-label float-left" for="{{$processo_visitante->id}}" style="    margin-top: 1px;">
                                                {{$processo_visitante->nome}}
                                                </br><span style="font-size: 12px; font-style: italic; color: #009688; letter-spacing: -0.5px;"><i class="mdi mdi-account-clock" style="font-size: 15px;"></i> {{$ficha_processo->data_processo_formatada ?? ''}}</span>
                                            </label>                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" maxLength="300" name="anotacao_{{$processo_visitante->id}}" id="anotacao_{{$processo_visitante->id}}" class="form-control" value="{{$ficha_processo->anotacao ?? ''}}" placeholder="Anotações">
                                    </div>
                                </div>
                                @endforeach  
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>

                @can('edit_ficha_visitante')
                    @if($visitante->status != 'FL')
                        <p></p>
                        <button class="btn btn-primary" type="submit">Atualizar Ações</button>
                    @endif
                @endcan

            @endif


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


@endsection
