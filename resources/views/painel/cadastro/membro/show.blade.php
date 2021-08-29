@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações do Membro</h4>
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

            <h4 class="card-title">Formulário de Atualização - Membro</h4>
            <p class="card-title-desc">O Membro cadastrado poderá em módulos posteriores, ter acesso ao sistema. Seu cadastro serve para adminstração do Gestor e atualização dos seus dados cadastrais e históricos de solicitações.</p>
            <form name="edit_membro" method="POST" action="{{route('membro.update', compact('membro'))}}"  class="needs-validation"  accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{$membro->nome}}" placeholder="Nome" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_membro">E-mail</label>
                                <input type="email" class="form-control" id="email_membro" name="email_membro" value="{{$membro->email}}" placeholder="E-mail">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control mask_cpf" value="{{$membro->cpf}}" placeholder="(999.999.999-99)">
                        </div>

                        <div class="col-md-2">
                            <label for="sexo">Sexo</label>
                            <select id="sexo" name="sexo" class="form-control" required>
                                <option value="">---</option>
                                <option value="M" {{($membro->sexo == 'M') ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{($membro->sexo == 'F') ? 'selected' : '' }}>Feminino</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="celular">Telefone Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{$membro->celular}}" placeholder="(99) 99999-9999" required>
                        </div>
                        <div class="col-md-3">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{$membro->data_nascimento_ajustada}}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="naturalidade">Naturalidade</label>
                            <input type="text" name="naturalidade" id="naturalidade" class="form-control" value="{{$membro->naturalidade}}" required>
                        </div>
                        <div class="col-md-1">
                            <label for="path_avatar"></label> <br>
                            <a class="image-popup-no-margins" href="{{$membro->imagem}}">
                                <img class="avatar-sm mr-3 rounded-circle" alt="200x200" width="200" src="{{$membro->imagem}}" data-holder-rendered="true">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <label for="path_imagem">Avatar Usuário</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" id="path_imagem" name="path_imagem" accept="image/*">
                                <label class="custom-file-label" for="path_imagem">Selecionar Avatar</label>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Pessoais - FIM -->


                <!-- Dados Complementares - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Complementares</h5>
                </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao_membro">Situação</label>
                                <select id="situacao_membro" name="situacao_membro" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="A" {{($membro->status == 'A') ? 'selected' : '' }}>Ativo</option>
                                    <option value="I" {{($membro->status == 'I') ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="estado_civil">Estado Civil</label>
                            <select id="estado_civil" name="estado_civil" class="form-control">
                                <option value="">---</option>
                                <option value="SL" {{($membro->estado_civil == 'SL') ? 'selected' : '' }}>Solteiro</option>
                                <option value="CS" {{($membro->estado_civil == 'CS') ? 'selected' : '' }}>Casado</option>
                                <option value="SP" {{($membro->estado_civil == 'SP') ? 'selected' : '' }}>Separado</option>
                                <option value="DV" {{($membro->estado_civil == 'DV') ? 'selected' : '' }}>Divorciado</option>
                                <option value="VI" {{($membro->estado_civil == 'VI') ? 'selected' : '' }}>Viúvo</option>
                                <option value="UE" {{($membro->estado_civil == 'UE') ? 'selected' : '' }}>União Estável</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="conjuge">Nome Cônjuge</label>
                                <input type="text" class="form-control" id="conjuge" name="conjuge" value="{{$membro->conjuge}}" placeholder="Nome">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="data_casamento">Data Casamento</label>
                            <input type="date" name="data_casamento" id="data_casamento" class="form-control" value="{{$membro->data_casamento_ajustada}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="escolaridade">Escolaridade</label>
                            <select id="escolaridade" name="escolaridade" class="form-control">
                                <option value="">---</option>
                                <option value="EF" {{($membro->escolaridade == 'EF') ? 'selected' : '' }}>Ensino Fundamental</option>
                                <option value="EM" {{($membro->escolaridade == 'EM') ? 'selected' : '' }}>Ensino Médio</option>
                                <option value="EP" {{($membro->escolaridade == 'EP') ? 'selected' : '' }}>Ensino Profissionalizante</option>
                                <option value="ES" {{($membro->escolaridade == 'ES') ? 'selected' : '' }}>Ensino Superior</option>
                                <option value="MS" {{($membro->escolaridade == 'MS') ? 'selected' : '' }}>Mestrado</option>
                                <option value="DO" {{($membro->escolaridade == 'DO') ? 'selected' : '' }}>Doutorado</option>
                                <option value="PD" {{($membro->escolaridade == 'PD') ? 'selected' : '' }}>Pós Doutorado</option>
                                <option value="NA" {{($membro->escolaridade == 'NA') ? 'selected' : '' }}>Não Alfabetizado</option>
                                <option value="AL" {{($membro->escolaridade == 'AL') ? 'selected' : '' }}>Alfabetizado</option>
                                <option value="NI" {{($membro->escolaridade == 'NI') ? 'selected' : '' }}>Não Informada</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-3">
                            <label for="profissao">Profissão</label>
                            <input type="text" name="profissao" id="profissao" class="form-control" value="{{$membro->profissao}}" placeholder="Profissão">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_pai">Nome do Pai</label>
                            <input type="text" name="nome_pai" id="nome_pai" class="form-control" value="{{$membro->nome_pai}}" placeholder="Nome do Pai">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_mae">Nome da Mãe</label>
                            <input type="text" name="nome_mae" id="nome_mae" class="form-control" value="{{$membro->nome_mae}}" placeholder="Nome da Mãe" required>
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
                            <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                            <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{$membro->end_cep}}" placeholder="99.999-999">
                        </div>

                        <div class="col-md-4">
                            <label for="end_cidade">Cidade</label>
                            <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{$membro->end_cidade}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_uf">Estado</label>
                            <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{$membro->end_uf}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_bairro">Bairro</label>
                            <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{$membro->end_bairro}}">
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="end_endereco">Endereço</label>
                            <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{$membro->end_logradouro}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_numero">Número</label>
                            <input type="text" name="end_numero" id="end_numero" value="{{$membro->end_numero}}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="end_complemento">Complemento </label>
                            <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{$membro->end_complemento}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Endereço - FIM -->


                <!-- Dados Eclesiásticos - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Eclesiásticos</h5>
                </div>

                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="checkbox" id="is_pastor" name="is_pastor" {{ ($membro->is_pastor == 'S') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_pastor">
                                    Pastor
                                </label>
                            </div>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="numero_rol">Número ROL</label>
                                <input type="text" class="form-control" id="numero_rol" name="numero_rol" value="{{$membro->numero_rol}}" placeholder="Número ROL">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="tipo_membro">Tipo Membro</label>
                            <select id="tipo_membro" name="tipo_membro" class="form-control" required>
                                <option value="">---</option>
                                <option value="CM" {{($membro->tipo_membro == 'CM') ? 'selected' : '' }}>Comungante</option>
                                <option value="NC" {{($membro->tipo_membro == 'NC') ? 'selected' : '' }}>Não Comungante</option>
                                <option value="NM" {{($membro->tipo_membro == 'NM') ? 'selected' : '' }}>Não Membro</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="local_congrega">Onde Congrega</label>
                                <select id="local_congrega" name="local_congrega" class="form-control">
                                    <option value="">---</option>
                                    @foreach($local_congregas as $local_congrega)
                                        <option value="{{$local_congrega->id}}" {{($local_congrega->id == $membro->local_congrega_id) ? 'selected' : '' }}>{{$local_congrega->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="checkbox" id="is_disciplina" name="is_disciplina"  {{ ($membro->is_disciplina == 'S') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_disciplina">
                                    Em Disicplina ?
                                </label>
                            </div>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                    </div>
                    <p></p>
                    <fieldset class="border p-3">
                        <legend class="w-auto">Batismo</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_batismo">Data</label>
                                <input type="date" name="data_batismo" id="data_batismo" class="form-control" value="{{$membro->data_batismo_ajustada}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_batismo">Pastor</label>
                                <input type="text" name="pastor_batismo" id="pastor_batismo" class="form-control" value="{{$membro->pastor_batismo}}" placeholder="Pastor Batismo">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_batismo">Igreja</label>
                                <input type="text" name="igreja_batismo" id="igreja_batismo" class="form-control" value="{{$membro->igreja_batismo}}" placeholder="Igreja Batismo">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>
                    <fieldset class="border p-3">
                        <legend class="w-auto">Profissão de Fé</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_profissao_fe">Data</label>
                                <input type="date" name="data_profissao_fe" id="data_profissao_fe" class="form-control" value="{{$membro->data_profissao_fe_ajustada}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_profissao_fe">Pastor</label>
                                <input type="text" name="pastor_profissao_fe" id="pastor_profissao_fe" class="form-control" value="{{$membro->pastor_profissao_fe}}" placeholder="Pastor Profissão Fé">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_profissao_fe">Igreja</label>
                                <input type="text" name="igreja_profissao_fe" id="igreja_profissao_fe" class="form-control" value="{{$membro->igreja_profissao_fe}}" placeholder="Igreja Profissão Fé">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>

                    <fieldset class="border p-3">
                        <legend class="w-auto">Admissão/Demissão</legend>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="numero_ata">Número ATA</label>
                                    <input type="text" class="form-control" id="numero_ata" name="numero_ata" value="{{$membro->numero_ata}}" placeholder="Número Ata">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="data_admissao">Data Admissão</label>
                                <input type="date" name="data_admissao" id="data_admissao" class="form-control" value="{{$membro->data_admissao_ajustada}}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meio_admissao">Meio Admissão</label>
                                    <select id="meio_admissao" name="meio_admissao" class="form-control">
                                        <option value="">---</option>
                                        @foreach($meio_admissaos as $meio_admissao)
                                            <option value="{{$meio_admissao->id}}" {{($meio_admissao->id == $membro->meio_admissao_id) ? 'selected' : '' }}>{{$meio_admissao->nome}}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="data_demissao">Data Demissão</label>
                                <input type="date" name="data_demissao" id="data_demissao" class="form-control" value="{{$membro->data_demissao_ajustada}}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meio_demissao">Meio Demissão</label>
                                    <select id="meio_demissao" name="meio_demissao" class="form-control">
                                        <option value="">---</option>
                                        @foreach($meio_demissaos as $meio_demissao)
                                            <option value="{{$meio_demissao->id}}" {{($meio_demissao->id == $membro->meio_demissao_id) ? 'selected' : '' }}>{{$meio_demissao->nome}}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <p></p>

                <!-- Dados Eclesiásticos - FIM -->

                <!-- Dados Ministeriais -- INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Ministeriais</h5>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ministerio[]">Ministérios em Atividade</label>
                                <select class="select2 form-control select2-multiple"
                                    multiple="multiple" data-placeholder="Ministérios ..." id="ministerio[]" name="ministerio[]">
                                    @foreach($ministerios as $ministerio)
                                        <option value="{{$ministerio->id}}" {{ (in_array($ministerio->id, $membro->ministerios_ids())) ? 'selected' : '' }} >{{$ministerio->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="aptidao">Descrição das Aptidões</label>
                                <textarea class="form-control" id="aptidao" name="aptidao" placeholder="Aptidões" rows="3">{{ $membro->aptidao}}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Ministeriais -- FIM -->

                <!-- Dados Acesso -- INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Acesso (módulos futuros)</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao">Situação</label>
                                <select id="situacao" name="situacao" class="form-control">
                                    <option value="">---</option>
                                    <option value="A" {{($membro->user && $membro->user->situacao['status'] == 'A') ? 'selected' : '' }}>Ativo</option>
                                    <option value="I" {{($membro->user && $membro->user->situacao['status'] == 'I') ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="perfil">Perfil Acesso</label>
                                <select id="perfil" name="perfil" class="form-control">
                                    <option value="">---</option>
                                    @foreach($perfis as $perfil)
                                        <option value="{{$perfil->id}}" {{($membro->user && $perfil->id == $membro->user->perfil_id) ? 'selected' : '' }}>{{$perfil->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="email">Login de Acesso</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$membro->user->email ?? ''}}" placeholder="Login de Acesso">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
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

            <p><br></p>

            <div class="bg-soft-success p-3 rounded" style="margin-bottom:10px;">
                <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Informações Adicionais do Membro</h5>
            </div>

            <!-- Nav tabs - INI -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#historico_oficios" role="tab">
                        <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                        <span class="d-none d-sm-block">
                            <i onClick="location.href='{{route('historico_oficio.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Histórico do Ofício"></i>
                            Histórico de Ofiícios ( <code class="highlighter-rouge">{{ $historico_oficios->count() }}</code> )
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#historico_situacaos" role="tab">
                        <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                        <span class="d-none d-sm-block">
                            <i onClick="location.href='{{route('historico_situacao.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Histórico da Situação do Membro"></i>
                            Histórico das Situações ( <code class="highlighter-rouge">{{ $historico_situacaos->count() }}</code> )
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#historico_solicitacaos" role="tab">
                        <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                        <span class="d-none d-sm-block">
                            <i onClick="location.href='{{route('historico_solicitacao.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Histórico de Solicitação do Membro"></i>
                            Histórico de Solicitações ( <code class="highlighter-rouge">{{ $historico_solicitacaos->count() }}</code> )
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#membro_familias" role="tab">
                        <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                        <span class="d-none d-sm-block">
                            <i onClick="location.href='{{route('membro_familia.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Vínculo Familiar"></i>
                            Vínculos Familires ( <code class="highlighter-rouge">{{ $membro_familias->count() }}</code> )
                        </span>
                    </a>
                </li>
            </ul>
            <!-- Nav tabs - FIM -->


            <!-- Tab panes - INI -->
            <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - HISTORICO OFICIO - INI -->
                <div class="tab-pane active" id="historico_oficios" role="tabpanel">
                    <table id="dt_historico_oficios" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Ofício</th>
                                <th>Data Início</th>
                                <th>Data Fim</th>
                                <th>Comentário</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($historico_oficios as $historico_oficio)
                                <tr>
                                    <td>{{ $historico_oficio->data_fim_ordenacao }}</td>
                                    <td>{{ $historico_oficio->oficio->nome }}</td>
                                    <td>{{ $historico_oficio->data_inicio_formatada }}</td>
                                    <td>{{ $historico_oficio->data_fim_formatada }}</td>
                                    <td>{{ $historico_oficio->comentario_abreviado }}</td>
                                    <td style="text-align:center;">

                                        @can('edit_historico')
                                            <a href="{{route('historico_oficio.show', compact('membro', 'historico_oficio'))}}"><i class="fa fa-edit"
                                                    style="color: goldenrod" title="Editar o Histórico do Ofício"></i></a>
                                        @endcan

                                        @can('delete_historico')
                                            <a href="javascript:;" data-toggle="modal"
                                            onclick="deleteData('historico_oficio', '{{$membro->id}}', '{{$historico_oficio->id}}');"
                                                data-target="#modal-delete"><i class="fa fa-minus-circle"
                                                    style="color: crimson" title="Excluir o Histórico do Ofício"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhum registro encontrado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA HISTORICO OFICIO - FIM -->

                <!-- Nav tabs - HISTORICO SITUACAO MEMBRO - INI -->
                <div class="tab-pane" id="historico_situacaos" role="tabpanel">
                    <table id="dt_historico_situacaos" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Situação</th>
                                <th>Data Início</th>
                                <th>Data Fim</th>
                                <th>Comentário</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($historico_situacaos as $historico_situacao)
                                <tr>
                                    <td>{{ $historico_situacao->data_fim_ordenacao }}</td>
                                    <td>{{ $historico_situacao->situacao_membro->nome }}</td>
                                    <td>{{ $historico_situacao->data_inicio_formatada }}</td>
                                    <td>{{ $historico_situacao->data_fim_formatada }}</td>
                                    <td>{{ $historico_situacao->comentario_abreviado }}</td>
                                    <td style="text-align:center;">

                                        @can('edit_historico')
                                            <a href="{{route('historico_situacao.show', compact('membro', 'historico_situacao'))}}"><i class="fa fa-edit"
                                                    style="color: goldenrod" title="Editar o Histórico da Situação do Membro"></i></a>
                                        @endcan

                                        @can('delete_historico')
                                            <a href="javascript:;" data-toggle="modal"
                                            onclick="deleteData('historico_situacao', '{{$membro->id}}', '{{$historico_situacao->id}}');"
                                                data-target="#modal-delete"><i class="fa fa-minus-circle"
                                                    style="color: crimson" title="Excluir o Histórico da Situação do Membro"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhum registro encontrado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA HISTORICO SITUACAO MEMBRO - FIM -->

                <!-- Nav tabs - HISTORICO SOLICITACAO MEMBRO - INI -->
                <div class="tab-pane" id="historico_solicitacaos" role="tabpanel">
                    <table id="dt_historico_solicitacaos" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Ordenação</th>
                                <th>Solicitação</th>
                                <th>Líder</th>
                                <th>Data Solicitação</th>
                                <th>Data Realização</th>
                                <th>Comentário</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($historico_solicitacaos as $historico_solicitacao)
                                <tr>
                                    <td>{{ $historico_solicitacao->data_realizacao_ordenacao }}</td>
                                    <td>{{ $historico_solicitacao->tipo_solicitacao->nome }}</td>
                                    <td>{{ $historico_solicitacao->lider->nome }}</td>
                                    <td>{{ $historico_solicitacao->data_solicitacao_formatada }}</td>
                                    <td>{{ $historico_solicitacao->data_realizacao_formatada }}</td>
                                    <td>{{ $historico_solicitacao->comentario_abreviado }}</td>
                                    <td style="text-align:center;">

                                        @can('edit_historico')
                                            <a href="{{route('historico_solicitacao.show', compact('membro', 'historico_solicitacao'))}}"><i class="fa fa-edit"
                                                    style="color: goldenrod" title="Editar o Histórico da Solicitação do Membro"></i></a>
                                        @endcan

                                        @can('delete_historico')
                                            <a href="javascript:;" data-toggle="modal"
                                            onclick="deleteData('historico_solicitacao', '{{$membro->id}}', '{{$historico_solicitacao->id}}');"
                                                data-target="#modal-delete"><i class="fa fa-minus-circle"
                                                    style="color: crimson" title="Excluir o Histórico da Solicitação do Membro"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Nenhum registro encontrado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA HISTORICO SOLICITACAO MEMBRO - FIM -->

                <!-- Nav tabs - VINCULO FAMILIAR - INI -->
                <div class="tab-pane" id="membro_familias" role="tabpanel">
                    <table id="dt_membro_familias" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Vínculo</th>
                                <th>Membro da Família</th>
                                <th style="text-align:center;">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($membro_familias as $membro_familia)
                                <tr>
                                    <td>{{ $membro_familia->vinculo_familiar }}</td>
                                    <td>{{ $membro_familia->membro_familia->nome }}</td>
                                    <td style="text-align:center;">

                                        @can('delete_membro')
                                            <a href="javascript:;" data-toggle="modal"
                                            onclick="deleteData('membro_familia', '{{$membro->id}}', '{{$membro_familia->id}}');"
                                                data-target="#modal-delete"><i class="fa fa-minus-circle"
                                                    style="color: crimson" title="Excluir o Vínculo Familiar do Membro"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum registro encontrado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA VINCULO FAMILIAR - FIM -->

            </div>
            <!-- Tab panes - FIM -->

            @section('modal_target')"formSubmit();"@endsection
            @section('modal_type')@endsection
            @section('modal_name')"modal-delete"@endsection
            @section('modal_msg_title')Deseja excluir o registro ? @endsection
            @section('modal_msg_description')O registro selecionado será excluído
            definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
            @section('modal_close')Fechar @endsection
            @section('modal_save')Excluir @endsection

            <form action="" id="deleteForm" method="post">
                @csrf
                @method('DELETE')
            </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('head-css')
    <link href="{{asset('nazox/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('nazox/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('script-js')
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/select2/js/select2.min.js')}}"></script>

    <!-- form mask -->
    <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/lightbox.init.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('nazox/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('nazox/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('nazox/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('nazox/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('nazox/assets/js/pages/datatables.init.js') }}"></script>


    @if ($historico_oficios->count() > 0)
        <script>
            var table_hist_oficio = $('#dt_historico_oficios').DataTable({
                order: [
                    [0, "desc"]
                ],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
                language: {
                    url: '{{ asset('nazox/assets/localisation/pt_br.json') }}'
                }
            });
        </script>
    @endif

    @if ($historico_situacaos->count() > 0)
        <script>
            var table_hist_situacao = $('#dt_historico_situacaos').DataTable({
                order: [
                    [0, "desc"]
                ],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
                language: {
                    url: '{{ asset('nazox/assets/localisation/pt_br.json') }}'
                }
            });
        </script>
    @endif

    @if ($historico_solicitacaos->count() > 0)
        <script>
            var table_hist_solicitacao = $('#dt_historico_solicitacaos').DataTable({
                order: [
                    [0, "desc"]
                ],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
                language: {
                    url: '{{ asset('nazox/assets/localisation/pt_br.json') }}'
                }
            });
        </script>
    @endif

    @if ($membro_familias->count() > 0)
        <script>
            var table_membro_familia = $('#dt_membro_familias').DataTable({
                order: [
                    [1, "desc"]
                ],
                language: {
                    url: '{{ asset('nazox/assets/localisation/pt_br.json') }}'
                }
            });
        </script>
    @endif

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

    <script>

        function formSubmit() {
            $("#deleteForm").submit();
        }

        function deleteData(action, var1, var2) {
            var action = action;
            var data = [];
            data[0] = var1;
            data[1] = var2;

            if(action == 'historico_oficio'){
                deleteHistoricoOficio(data);
            }else if(action == 'historico_situacao'){
                deleteHistoricoSituacao(data);
            }else if(action == 'historico_solicitacao'){
                deleteHistoricoSolicitacao(data);
            }else if(action == 'membro_familia'){
                deleteMembroFamilia(data);
            }
        }

        function deleteHistoricoOficio(data) {
            var membro = data[0];
            var oficio = data[1];

            var url = '{{ route('historico_oficio.destroy', [':membro', ':oficio']) }}';
            url = url.replace(':membro', membro);
            url = url.replace(':oficio', oficio);
            $("#deleteForm").attr('action', url);
        }

        function deleteHistoricoSituacao(data) {
            var membro = data[0];
            var situacao = data[1];

            var url = '{{ route('historico_situacao.destroy', [':membro', ':situacao']) }}';
            url = url.replace(':membro', membro);
            url = url.replace(':situacao', situacao);
            $("#deleteForm").attr('action', url);
        }

        function deleteHistoricoSolicitacao(data) {
            var membro = data[0];
            var solicitacao = data[1];

            var url = '{{ route('historico_solicitacao.destroy', [':membro', ':solicitacao']) }}';
            url = url.replace(':membro', membro);
            url = url.replace(':solicitacao', solicitacao);
            $("#deleteForm").attr('action', url);
        }

        function deleteMembroFamilia(data) {
            var membro = data[0];
            var membro_familia = data[1];

            var url = '{{ route('membro_familia.destroy', [':membro', ':membro_familia']) }}';
            url = url.replace(':membro', membro);
            url = url.replace(':membro_familia', membro_familia);
            $("#deleteForm").attr('action', url);
        }

    </script>


@endsection
