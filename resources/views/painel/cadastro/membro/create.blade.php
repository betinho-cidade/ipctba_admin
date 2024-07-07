@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Novo Membro</h4>
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

            <h4 class="card-title">Formulário de Cadastro - Membro</h4>
            <p class="card-title-desc">O Membro cadastrado poderá em módulos posteriores, ter acesso ao sistema. Seu cadastro serve para adminstração do Gestor e atualização dos seus dados cadastrais e históricos de solicitações.</p>
            <form name="create_membro" method="POST" action="{{route('membro.store')}}"  class="needs-validation"  accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" placeholder="Nome" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_membro">E-mail</label>
                                <input type="email" class="form-control" id="email_membro" name="email_membro" value="{{old('email_membro')}}" placeholder="E-mail">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control mask_cpf" value="{{old('cpf')}}" placeholder="(999.999.999-99)">
                        </div>

                        <div class="col-md-2">
                            <label for="sexo">Sexo</label>
                            <select id="sexo" name="sexo" class="form-control" required>
                                <option value="">---</option>
                                <option value="M" {{(old('sexo') == 'M') ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{(old('sexo') == 'F') ? 'selected' : '' }}>Feminino</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="celular">Telefone Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{old('celular')}}" placeholder="(99) 99999-9999" required>
                        </div>
                        <div class="col-md-3">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{old('data_nascimento')}}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="naturalidade">Local de Nascimento</label>
                            <input type="text" name="naturalidade" id="naturalidade" class="form-control" value="{{old('naturalidade')}}" required>
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
                                    <option value="A" {{(old('situacao_membro') == 'A') ? 'selected' : '' }}>Ativo</option>
                                    <option value="I" {{(old('situacao_membro') == 'I') ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="estado_civil">Estado Civil</label>
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
                                <input type="text" class="form-control" id="conjuge" name="conjuge" value="{{old('conjuge')}}" placeholder="Nome">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="data_casamento">Data Casamento</label>
                            <input type="date" name="data_casamento" id="data_casamento" class="form-control" value="{{old('data_casamento')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="escolaridade">Escolaridade</label>
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
                            <input type="text" name="profissao" id="profissao" class="form-control" value="{{old('profissao')}}" placeholder="Profissão">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_pai">Nome do Pai</label>
                            <input type="text" name="nome_pai" id="nome_pai" class="form-control" value="{{old('nome_pai')}}" placeholder="Nome do Pai">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_mae">Nome da Mãe</label>
                            <input type="text" name="nome_mae" id="nome_mae" class="form-control" value="{{old('nome_mae')}}" placeholder="Nome da Mãe" required>
                        </div>
                    </div>
                    <p></p>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-soft-primary">
                                <div class="card-body itens-drag-drog">
                                    <h4 class="card-title"><button id="addRow" type="button" class="btn btn-secondary" style="font-size: xx-small;">+</button> Filhos</h4>
                                    <div class="newRow list-group" id="player-list">
                                    </div>
                                </div>
                            </div>
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
                            <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{old('end_cep')}}" placeholder="99.999-999">
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


                <!-- Dados Eclesiásticos - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Eclesiásticos</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numero_rol">Número ROL</label>
                                <input type="text" class="form-control" id="numero_rol" name="numero_rol" value="{{old('numero_rol')}}" placeholder="Número ROL">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="tipo_membro">Tipo Membro</label>
                            <select id="tipo_membro" name="tipo_membro" class="form-control" required>
                                <option value="">---</option>
                                <option value="CM" {{(old('tipo_membro') == 'CM') ? 'selected' : '' }}>Comungante</option>
                                <option value="NC" {{(old('tipo_membro') == 'NC') ? 'selected' : '' }}>Não Comungante</option>
                                <option value="NM" {{(old('tipo_membro') == 'NM') ? 'selected' : '' }}>Não Membro</option>
                                <option value="PS" {{(old('tipo_membro') == 'PS') ? 'selected' : '' }}>Pastor</option>
                                <option value="EP" {{(old('tipo_membro') == 'EP') ? 'selected' : '' }}>Em Processo</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status_participacao">Status de Participação</label>
                                <select id="status_participacao" name="status_participacao" class="form-control" required>
                                    <option value="">---</option>
                                    @foreach($status_participacaos as $status_participacao)
                                        <option value="{{$status_participacao->id}}" {{($status_participacao->id == old('status_participacao')) ? 'selected' : '' }}>{{$status_participacao->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="checkbox" id="is_disciplina">
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
                        <legend class="w-auto" style="font-size: 18px">Batismo</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_batismo">Data</label>
                                <input type="date" name="data_batismo" id="data_batismo" class="form-control" value="{{old('data_batismo')}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_batismo">Pastor</label>
                                <input type="text" name="pastor_batismo" id="pastor_batismo" class="form-control" value="{{old('pastor_batismo')}}" placeholder="Pastor Batismo">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_batismo">Igreja</label>
                                <input type="text" name="igreja_batismo" id="igreja_batismo" class="form-control" value="{{old('igreja_batismo')}}" placeholder="Igreja Batismo">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>
                    <fieldset class="border p-3">
                        <legend class="w-auto" style="font-size: 18px">Profissão de Fé</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_profissao_fe">Data</label>
                                <input type="date" name="data_profissao_fe" id="data_profissao_fe" class="form-control" value="{{old('data_profissao_fe')}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_profissao_fe">Pastor</label>
                                <input type="text" name="pastor_profissao_fe" id="pastor_profissao_fe" class="form-control" value="{{old('pastor_profissao_fe')}}" placeholder="Pastor Profissão Fé">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_profissao_fe">Igreja</label>
                                <input type="text" name="igreja_profissao_fe" id="igreja_profissao_fe" class="form-control" value="{{old('igreja_profissao_fe')}}" placeholder="Igreja Profissão Fé">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>

                    <fieldset class="border p-3">
                        <legend class="w-auto" style="font-size: 18px">Igreja Anterior</legend>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="igreja_old_nome">Nome Igreja</label>
                                    <input type="text" class="form-control" id="igreja_old_nome" name="igreja_old_nome" value="{{old('igreja_old_nome')}}" placeholder="Nome Igreja Anterior">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label for="igreja_old_cidade">Cidade/Estado</label>
                                    <input type="text" class="form-control" id="igreja_old_cidade" name="igreja_old_cidade" value="{{old('igreja_old_cidade')}}" placeholder="Cidade Anterior">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="igreja_old_pastor">Pastor</label>
                                    <input type="text" class="form-control" id="igreja_old_pastor" name="igreja_old_pastor" value="{{old('igreja_old_pastor')}}" placeholder="Pastor Anterior">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="igreja_old_pastor_email">E-mail Pastor</label>
                                    <input type="email" class="form-control" id="igreja_old_pastor_email" name="igreja_old_pastor_email" value="{{old('igreja_old_pastor_email')}}" placeholder="E-mail Pastor">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="igreja_old_pastor_fone">Telefone Pastor</label>
                                    <input type="text" class="form-control mask_celular" id="igreja_old_pastor_fone" name="igreja_old_pastor_fone" value="{{old('igreja_old_pastor_fone')}}" placeholder="Telefone Pastor">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>                            
                        </div>
                    </fieldset>
                    <p></p>

                    <fieldset class="border p-3">
                        <legend class="w-auto" style="font-size: 18px">Admissão/Demissão</legend>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="numero_ata">Número ATA</label>
                                    <input type="text" class="form-control" id="numero_ata" name="numero_ata" value="{{old('numero_ata')}}" placeholder="Número Ata">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="data_admissao">Data Admissão</label>
                                <input type="date" name="data_admissao" id="data_admissao" class="form-control" value="{{old('data_admissao')}}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meio_admissao">Meio Admissão</label>
                                    <select id="meio_admissao" name="meio_admissao" class="form-control">
                                        <option value="">---</option>
                                        @foreach($meio_admissaos as $meio_admissao)
                                            <option value="{{$meio_admissao->id}}" {{($meio_admissao->id == old('meio_admissao')) ? 'selected' : '' }}>{{$meio_admissao->nome}}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="data_demissao">Data Demissão</label>
                                <input type="date" name="data_demissao" id="data_demissao" class="form-control" value="{{old('data_demissao')}}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meio_demissao">Meio Demissão</label>
                                    <select id="meio_demissao" name="meio_demissao" class="form-control">
                                        <option value="">---</option>
                                        @foreach($meio_demissaos as $meio_demissao)
                                            <option value="{{$meio_demissao->id}}" {{($meio_demissao->id == old('meio_demissao')) ? 'selected' : '' }}>{{$meio_demissao->nome}}</option>
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
                                        <option value="{{$ministerio->id}}">{{$ministerio->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="aptidao">Descrição das Aptidões</label>
                                <textarea class="form-control" id="aptidao" name="aptidao" placeholder="Aptidões" rows="3">{{ old('aptidao')}}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Ministeriais -- FIM -->

                <!-- Anotações Gerais -- INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Anotações Gerais</h5>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="anotacao">Informações adicionais sobre o membro</label>
                                <textarea class="form-control" id="anotacao" name="anotacao" rows="3">{{ old('anotacao')}}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                <!-- Anotações Gerais -- FIM -->

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
                                    <option value="A" {{(old('situacao') == 'A') ? 'selected' : '' }}>Ativo</option>
                                    <option value="I" {{(old('situacao') == 'I') ? 'selected' : '' }}>Inativo</option>
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
                                        <option value="{{$perfil->id}}" {{($perfil->id == old('perfil')) ? 'selected' : '' }}>{{$perfil->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="email">Login de Acesso</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Login de Acesso">
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
    <link href="{{asset('css/drag_drop.css')}}" id="app-style" rel="stylesheet" type="text/css" />
@endsection

@section('script-js')
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('js/Sortable.js')}}"></script>
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

    <script type="text/javascript">
        $("#addRow").click(function () {

            var html = '';
            html += '<div class="row list-group-item inputNewRow">';

            html += '    <div class="handle flex-center" style="font-size: xx-small;"><i class="fa fa-bars"></i></div>';

            html += '        <div class="row form-group">';
            html += '                <div class="col-md-6">';
            html += '                    <label for="filho_nome">Nome</label>';
            html += '                    <input type="text" name="filho_nome[]" id="filho_nome[]" class="form-control" value="{{old('nome_filho[]')}}" required>';
            html += '                    <div class="valid-feedback">ok!</div>';
            html += '                    <div class="invalid-feedback">Inválido!</div>';
            html += '                </div>';
            html += '                <div class="col-md-3">';
            html += '                    <label for="filho_data_nascimento">Data Nascimento</label>';
            html += '                    <input type="date" name="filho_data_nascimento[]" id="filho_data_nascimento[]" class="form-control" value="{{old('filho_data_nascimento[]')}}" required>';
            html += '                    <div class="valid-feedback">ok!</div>';
            html += '                    <div class="invalid-feedback">Inválido!</div>';
            html += '                </div>';
            html += '                <div class="col-md-3">';
            html += '                    <label for="filho_sexo">Sexo</label>';
            html += '                    <select id="filho_sexo[]" name="filho_sexo[]" class="form-control" required>';
            html += '                        <option value="">---</option>';
            html += '                        <option value="M" {{(old('filho_sexo[]]') == 'M') ? 'selected' : '' }}>Masculino</option>';
            html += '                        <option value="F" {{(old('filho_sexo[]') == 'F') ? 'selected' : '' }}>Feminino</option>';
            html += '                    </select>';
            html += '                    <div class="valid-feedback">ok!</div>';
            html += '                    <div class="invalid-feedback">Inválido!</div>';
            html += '                </div> ';
            html += '        </div>';

            html += '       <button id="removeRow" type="button" class="btn btn-danger" style="font-size: xx-small;">-</button>';

            html += '</div>';

            $('.newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('.inputNewRow').remove();
        });

    </script>

    <script>
        let player = document.getElementById("player-list");
        new Sortable(player,{
                        handle:'.handle',
                        animation:200,
        });
    </script>


@endsection
