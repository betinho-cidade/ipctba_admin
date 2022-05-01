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
                    @can('edit_membro')
                    <span class="float-right" style="align-top: center; font-size: 14px;">
                        <a href="{{route('membro.pdf', compact('membro'))}}"><i class="fa fa-download color: goldenrod" title="Gerar PDF do Membro"></i></a>
                    </span>
                    @endcan
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="nome" name="nome" value="{{$membro->nome}}" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_membro">E-mail</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="email" class="form-control" id="email_membro" name="email_membro" value="{{$membro->email}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="celular">Telefone Celular</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="celular" id="celular" class="form-control mask_celular" value="{{$membro->celular}}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{$membro->data_nascimento_ajustada}}" required>
                        </div>

                    </div>
                    @can('edit_membro')
                    <p></p>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="cpf">CPF</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="cpf" id="cpf" class="form-control mask_cpf" value="{{$membro->cpf}}">
                        </div>

                        <div class="col-md-2">
                            <label for="sexo">Sexo</label>
                            <select @if(!Gate::check('edit_membro')) disabled @endif id="sexo" name="sexo" class="form-control" required>
                                <option value="">---</option>
                                <option value="M" {{($membro->sexo == 'M') ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{($membro->sexo == 'F') ? 'selected' : '' }}>Feminino</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                        <div class="col-md-3">
                            <label for="naturalidade">Naturalidade</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="naturalidade" id="naturalidade" class="form-control" value="{{$membro->naturalidade}}" required>
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
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="file" class="custom-file-input" id="path_imagem" name="path_imagem" accept="image/*">
                                <label class="custom-file-label" for="path_imagem">Selecionar Avatar</label>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    @endcan
                    <p></p>
                <!-- Dados Pessoais - FIM -->

                @can('edit_membro')
                <!-- Dados Complementares - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Complementares</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="estado_civil">Estado Civil</label>
                            <select @if(!Gate::check('edit_membro')) disabled @endif id="estado_civil" name="estado_civil" class="form-control">
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conjuge">Nome Cônjuge</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="conjuge" name="conjuge" value="{{$membro->conjuge}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="data_casamento">Data Casamento</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="data_casamento" id="data_casamento" class="form-control" value="{{$membro->data_casamento_ajustada}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="escolaridade">Escolaridade</label>
                            <select @if(!Gate::check('edit_membro')) disabled @endif id="escolaridade" name="escolaridade" class="form-control">
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
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="profissao" id="profissao" class="form-control" value="{{$membro->profissao}}">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_pai">Nome do Pai</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="nome_pai" id="nome_pai" class="form-control" value="{{$membro->nome_pai}}">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_mae">Nome da Mãe</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="nome_mae" id="nome_mae" class="form-control" value="{{$membro->nome_mae}}" required>
                        </div>
                    </div>
                    <p></p>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-soft-primary">
                                <div class="card-body itens-drag-drog">
                                    <h4 class="card-title">
                                        @can('edit_membro')
                                            <button id="addRow" type="button" class="btn btn-secondary" style="font-size: xx-small;">+</button>
                                        @endif
                                        Filhos
                                    </h4>
                                    <div class="newRow list-group" id="player-list">

                                        @foreach($membro->membro_filhos as $membro_filho)
                                            <div class="row list-group-item inputNewRow">
                                                <div class="handle flex-center" style="font-size: xx-small;"><i class="fa fa-bars"></i></div>
                                                <div class="row form-group">
                                                    <div class="col-md-6">
                                                        <label for="filho_nome">Nome</label>
                                                        <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="filho_nome[]" id="filho_nome[]" class="form-control" value="{{$membro_filho->nome}}" required>
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="filho_data_nascimento">Data Nascimento</label>
                                                        <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="filho_data_nascimento[]" id="filho_data_nascimento[]" class="form-control" value="{{$membro_filho->data_nascimento_ajustada}}" required>
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                      </div>
                                                    <div class="col-md-3">
                                                        <label for="filho_sexo">Sexo</label>
                                                        <select @if(!Gate::check('edit_membro')) disabled @endif id="filho_sexo[]" name="filho_sexo[]" class="form-control" required>
                                                            <option value="">---</option>
                                                            <option value="M" {{($membro_filho->sexo == 'M') ? 'selected' : '' }}>Masculino</option>
                                                            <option value="F" {{($membro_filho->sexo == 'F') ? 'selected' : '' }}>Feminino</option>
                                                        </select>
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>

                                                @can('edit_membro')
                                                    <button id="removeRow" type="button" class="btn btn-danger" style="font-size: xx-small;">-</button>
                                                @endcan

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Dados Complementares - FIM -->
                @endcan


                <!-- Dados Endereço - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Endereço</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="end_cep">CEP</label>
                            <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{$membro->end_cep}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_cidade">Cidade</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{$membro->end_cidade}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_uf">Estado</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_uf" id="end_uf" class="form-control" value="{{$membro->end_uf}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_bairro">Bairro</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{$membro->end_bairro}}">
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="end_endereco">Endereço</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{$membro->end_logradouro}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_numero">Número</label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_numero" id="end_numero" value="{{$membro->end_numero}}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="end_complemento">Complemento </label>
                            <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{$membro->end_complemento}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Endereço - FIM -->

                @can('edit_membro')
                <!-- Dados Eclesiásticos - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Eclesiásticos</h5>
                </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao_membro">Situação</label>
                                <select @if(!Gate::check('edit_membro')) disabled @endif id="situacao_membro" name="situacao_membro" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="A" {{($membro->status == 'A') ? 'selected' : '' }}>Ativo</option>
                                    <option value="I" {{($membro->status == 'I') ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="numero_rol">Número ROL</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="numero_rol" name="numero_rol" value="{{$membro->numero_rol}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="tipo_membro">Tipo Membro</label>
                            <select @if(!Gate::check('edit_membro')) disabled @endif id="tipo_membro" name="tipo_membro" class="form-control" required>
                                <option value="">---</option>
                                <option value="CM" {{($membro->tipo_membro == 'CM') ? 'selected' : '' }}>Comungante</option>
                                <option value="NC" {{($membro->tipo_membro == 'NC') ? 'selected' : '' }}>Não Comungante</option>
                                <option value="NM" {{($membro->tipo_membro == 'NM') ? 'selected' : '' }}>Não Membro</option>
                                <option value="PS" {{($membro->tipo_membro == 'PS') ? 'selected' : '' }}>Pastor</option>
                                <option value="EP" {{($membro->tipo_membro == 'EP') ? 'selected' : '' }}>Em Processo</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status_participacao">Status de Participação</label>
                                <select @if(!Gate::check('edit_membro')) disabled @endif id="status_participacao" name="status_participacao" class="form-control">
                                    <option value="">---</option>
                                    @foreach($status_participacaos as $status_participacao)
                                        <option value="{{$status_participacao->id}}" {{($status_participacao->id == $membro->status_participacao_id) ? 'selected' : '' }}>{{$status_participacao->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check mb-1">
                                <input @if(!Gate::check('edit_membro')) disabled @endif class="form-check-input" type="checkbox" id="is_disciplina" name="is_disciplina"  {{ ($membro->is_disciplina == 'S') ? 'checked' : '' }}>
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
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="data_batismo" id="data_batismo" class="form-control" value="{{$membro->data_batismo_ajustada}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_batismo">Pastor</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="pastor_batismo" id="pastor_batismo" class="form-control" value="{{$membro->pastor_batismo}}">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_batismo">Igreja</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="igreja_batismo" id="igreja_batismo" class="form-control" value="{{$membro->igreja_batismo}}">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>
                    <fieldset class="border p-3">
                        <legend class="w-auto" style="font-size: 18px">Profissão de Fé</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_profissao_fe">Data</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="data_profissao_fe" id="data_profissao_fe" class="form-control" value="{{$membro->data_profissao_fe_ajustada}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_profissao_fe">Pastor</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="pastor_profissao_fe" id="pastor_profissao_fe" class="form-control" value="{{$membro->pastor_profissao_fe}}">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_profissao_fe">Igreja</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" name="igreja_profissao_fe" id="igreja_profissao_fe" class="form-control" value="{{$membro->igreja_profissao_fe}}">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>

                    <fieldset class="border p-3">
                        <legend class="w-auto" style="font-size: 18px">Igreja Anterior</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="igreja_old_nome">Nome Igreja</label>
                                    <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="igreja_old_nome" name="igreja_old_nome" value="{{$membro->igreja_old_nome}}">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="igreja_old_cidade">Cidade/Estado</label>
                                    <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="igreja_old_cidade" name="igreja_old_cidade" value="{{$membro->igreja_old_cidade}}">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="igreja_old_pastor">Pastor</label>
                                    <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="igreja_old_pastor" name="igreja_old_pastor" value="{{$membro->igreja_old_pastor}}">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="igreja_old_pastor_email">E-mail Pastor</label>
                                    <input @if(!Gate::check('edit_membro')) disabled @endif type="email" class="form-control" id="igreja_old_pastor_email" name="igreja_old_pastor_email" value="{{$membro->igreja_old_pastor_email}}">
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
                                    <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="numero_ata" name="numero_ata" value="{{$membro->numero_ata}}">
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="data_admissao">Data Admissão</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="data_admissao" id="data_admissao" class="form-control" value="{{$membro->data_admissao_ajustada}}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meio_admissao">Meio Admissão</label>
                                    <select @if(!Gate::check('edit_membro')) disabled @endif id="meio_admissao" name="meio_admissao" class="form-control">
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
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="date" name="data_demissao" id="data_demissao" class="form-control" value="{{$membro->data_demissao_ajustada}}">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meio_demissao">Meio Demissão</label>
                                    <select @if(!Gate::check('edit_membro')) disabled @endif id="meio_demissao" name="meio_demissao" class="form-control">
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
                @endcan

                @can('edit_membro')
                <!-- Dados Ministeriais -- INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Ministeriais</h5>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ministerio[]">Ministérios em Atividade</label>
                                <select @if(!Gate::check('edit_membro')) disabled @endif class="select2 form-control select2-multiple"
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
                                <textarea @if(!Gate::check('edit_membro')) disabled @endif class="form-control" id="aptidao" name="aptidao" rows="3">{{ $membro->aptidao}}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Ministeriais -- FIM -->
                @endcan

                @can('edit_membro')
                <!-- Dados Acesso -- INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Acesso (módulos futuros)</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao">Situação</label>
                                <select @if(!Gate::check('edit_membro')) disabled @endif id="situacao" name="situacao" class="form-control">
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
                                <select @if(!Gate::check('edit_membro')) disabled @endif id="perfil" name="perfil" class="form-control">
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
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="text" class="form-control" id="email" name="email" value="{{$membro->user->email ?? ''}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="password" class="form-control" id="password" name="password">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password_confirm">Senha Confirmação</label>
                                <input @if(!Gate::check('edit_membro')) disabled @endif type="password" class="form-control" id="password_confirm" name="password_confirm">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                <!-- Dados Pessoais -- FIM -->
                @endcan

                @can('edit_membro')
                    <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
                @endcan
            </form>
            <!-- FORMULÁRIO - FIM -->

            @can('edit_membro')
            <p><br></p>

            <div class="bg-soft-success p-3 rounded" style="margin-bottom:10px;">
                <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Informações Adicionais do Membro</h5>
            </div>


            <!-- Nav tabs - HISTORICO OFICIO - INI -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#historico_oficios" role="tab">
                        <span class="d-sm-block">
                            @can('create_historico_oficio')
                                <i onClick="location.href='{{route('historico_oficio.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Histórico do Ofício"></i>
                            @endcan
                            Histórico de Ofícios ( <code class="highlighter-rouge">{{ $historico_oficios->count() }}</code> )
                        </span>
                    </a>
                </li>
            </ul>

                <div class="tab-content p-3 text-muted tab-response-mobile">
                    <div class="tab-pane active" id="historico_oficios" role="tabpanel">
                        <table id="dt_historico_oficios" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Ordem</th>
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

                                            @can('view_historico_oficio')
                                                <a href="{{route('historico_oficio.show', compact('membro', 'historico_oficio'))}}"><i class="fa fa-edit"
                                                        style="color: goldenrod" title="Editar o Histórico do Ofício"></i></a>
                                            @endcan

                                            @can('delete_historico_oficio')
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
                </div>
            <!-- Nav tabs - LISTA HISTORICO OFICIO - FIM -->

            <p><br></p>

            <!-- Nav tabs - HISTORICO SITUACAO MEMBRO - INI -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#historico_situacaos" role="tab">
                        <span class="d-sm-block">
                            @can('create_historico_situacao')
                                <i onClick="location.href='{{route('historico_situacao.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Histórico da Situação do Membro"></i>
                            @endcan
                            Histórico das Situações ( <code class="highlighter-rouge">{{ $historico_situacaos->count() }}</code> )
                        </span>
                    </a>
                </li>
            </ul>

                <div class="tab-content p-3 text-muted tab-response-mobile">
                    <div class="tab-pane active" id="historico_situacaos" role="tabpanel">
                        <table id="dt_historico_situacaos" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Ordem</th>
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

                                            @can('edit_historico_situacao')
                                                <a href="{{route('historico_situacao.show', compact('membro', 'historico_situacao'))}}"><i class="fa fa-edit"
                                                        style="color: goldenrod" title="Editar o Histórico da Situação do Membro"></i></a>
                                            @endcan

                                            @can('delete_historico_situacao')
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
                </div>
            <!-- Nav tabs - LISTA HISTORICO SITUACAO MEMBRO - FIM -->

            <p><br></p>

            <!-- Nav tabs - HISTORICO SOLICITACAO MEMBRO - INI -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#historico_solicitacaos" role="tab">
                        <span class="d-sm-block">
                            Histórico de Solicitações ( <code class="highlighter-rouge">{{ $historico_solicitacaos->count() }}</code> )
                        </span>
                    </a>
                </li>
            </ul>

                <div class="tab-content p-3 text-muted tab-response-mobile">
                    <div class="tab-pane active" id="historico_solicitacaos" role="tabpanel">
                        <table id="dt_historico_solicitacaos" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Ordem</th>
                                    <th>Solicitação</th>
                                    <th>Líder</th>
                                    <th>Data Agendamento</th>
                                    <th>Data Realização</th>
                                    <th>Comentário</th>
                                    <th style="text-align:center;">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($historico_solicitacaos as $agenda_solicitacao)
                                    <tr>
                                        <td>{{ $agenda_solicitacao->data_agendamento_ordenacao }}</td>
                                        <td>{{ $agenda_solicitacao->tipo_solicitacao->nome }}</td>
                                        <td>{{ $agenda_solicitacao->lider->nome }}</td>
                                        <td>{{ $agenda_solicitacao->data_agendamento_formatada }}</td>
                                        <td>{{ $agenda_solicitacao->data_realizacao_formatada }}</td>
                                        <td>{{ $agenda_solicitacao->comentario_abreviado }}</td>
                                        <td style="text-align:center;">

                                            @can('view_agenda_solicitacao')
                                                <a href="{{route('agenda_solicitacao.show', compact('agenda_solicitacao'))}}"><i class="fa fa-edit"
                                                        style="color: goldenrod" title="Visualizar a Agenda / Solicitação do Membro"></i></a>
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
                </div>
            <!-- Nav tabs - LISTA HISTORICO SOLICITACAO MEMBRO - FIM -->

            <p><br></p>

            <!-- Nav tabs - VINCULO FAMILIAR - INI -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#membro_familias" role="tab">
                        <span class="d-sm-block">
                            @can('create_historico_familiar')
                                <i onClick="location.href='{{route('membro_familia.create', compact('membro'))}}';" class="fa fa-plus-square" style="color: goldenrod; margin-right:5px;" title="Novo Vínculo Familiar"></i>
                            @endcan
                            Vínculos Familires ( <code class="highlighter-rouge">{{ $membro_familias->count() }}</code> )
                        </span>
                    </a>
                </li>
            </ul>
            <div class="tab-content p-3 text-muted tab-response-mobile">
                <div class="tab-pane active" id="membro_familias" role="tabpanel">
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

                                        @can('delete_historico_familiar')
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
            </div>
            <!-- Nav tabs - LISTA VINCULO FAMILIAR - FIM -->
            @endcan

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
    <link href="{{asset('css/drag_drop.css')}}" id="app-style" rel="stylesheet" type="text/css" />
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

    <script src="{{asset('js/Sortable.js')}}"></script>


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

        function deleteMembroFamilia(data) {
            var membro = data[0];
            var membro_familia = data[1];

            var url = '{{ route('membro_familia.destroy', [':membro', ':membro_familia']) }}';
            url = url.replace(':membro', membro);
            url = url.replace(':membro_familia', membro_familia);
            $("#deleteForm").attr('action', url);
        }

    </script>

    @can('edit_membro')
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
    @endcan


@endsection
