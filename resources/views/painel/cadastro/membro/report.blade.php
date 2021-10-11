<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page-break {
                page-break-after: always;
            }

        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   </head>

<body>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 style="color:#575757;">Relatório do Membro</h4>
            <p>Informações do membro {{ strtoupper($membro->nome) }} dispostas em formato PDF para armazenamento e impressão.</p>


            <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                <hr class="mt-2 mb-3"/>
                <h5 class="text-center">Dados Pessoais</h5>
                <hr class="mt-2 mb-3"/>
            </div>

            @if($membro->nome)
                <div>
                    <b>Nome: </b>{{ $membro->nome }}<br>
                </div>
            @endif

            @if($membro->email)
            <div>
                <b>E-mail: </b>{{ $membro->email }}<br>
            </div>
            @endif

            @if($membro->cpf)
            <div>
                <b>Cpf: </b>{{ $membro->cpf }}<br>
            </div>
            @endif

            @if($membro->sexo)
            <div>
                <b>Sexo: </b>{{ $membro->descricao_sexo }}<br>
            </div>
            @endif

            @if($membro->celular)
            <div>
                <b>Celular: </b>{{ $membro->celular}}<br>
            </div>
            @endif

            @if($membro->data_nascimento)
            <div>
                <b>Data Nascimento: </b>{{ $membro->data_nascimento_formatada}}<br>
            </div>
            @endif

            @if($membro->naturalidade)
            <div>
                <b>Naturalidade: </b>{{ $membro->naturalidade}}<br>
            </div>
            @endif

            <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                <hr class="mt-2 mb-3"/>
                <h5 class="text-center">Dados Complementares</h5>
                <hr class="mt-2 mb-3"/>
            </div>

            @if($membro->situacao)
                <div>
                    <b>Status: </b>{{ $membro->descricao_situacao}}<br>
                </div>
            @endif

            @if($membro->estado_civil)
                <div>
                    <b>Estado Civil: </b>{{ $membro->descricao_estado_civil }}<br>
                </div>
            @endif

            @if($membro->conjuge)
                <div>
                    <b>Cônjuge: </b>{{ $membro->conjuge }}<br>
                </div>
            @endif

            @if($membro->data_casamento)
                <div>
                    <b>Data Casamento: </b>{{ $membro->data_casamento_formatada }}<br>
                </div>
            @endif

            @if($membro->escolaridade)
                <div>
                    <b>Escolaridade: </b>{{ $membro->descricao_escolaridade }}<br>
                </div>
            @endif

            @if($membro->profissao)
                <div>
                    <b>Profissão: </b>{{ $membro->profissao }}<br>
                </div>
            @endif

            @if($membro->nome_pai)
                <div>
                    <b>Nome do Pai: </b>{{ $membro->nome_pai }}<br>
                </div>
            @endif

            @if($membro->nome_mae)
                <div>
                    <b>Nome da Mãe: </b>{{ $membro->nome_mae }}<br>
                </div>
            @endif

            <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                <hr class="mt-2 mb-3"/>
                <h5 class="text-center">Dados Endereço</h5>
                <hr class="mt-2 mb-3"/>
            </div>

            @if($membro->end_cep)
                <div>
                    <b>CEP: </b>{{ $membro->end_cep}}<br>
                </div>
            @endif

            @if($membro->end_cidade)
                <div>
                    <b>Cidade: </b>{{ $membro->end_cidade}}<br>
                </div>
            @endif

            @if($membro->end_uf)
                <div>
                    <b>UF: </b>{{ $membro->end_uf}}<br>
                </div>
            @endif

            @if($membro->end_bairro)
                <div>
                    <b>Bairro: </b>{{ $membro->end_bairro}}<br>
                </div>
            @endif

            @if($membro->end_logradouro)
                <div>
                    <b>Endereço: </b>{{ $membro->end_logradouro}}<br>
                </div>
            @endif

            @if($membro->end_numero)
                <div>
                    <b>Número: </b>{{ $membro->end_numero}}<br>
                </div>
            @endif

            @if($membro->end_complemento)
                <div>
                    <b>Complemento: </b>{{ $membro->end_complemento}}<br>
                </div>
            @endif

            <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                <hr class="mt-2 mb-3"/>
                <h5 class="text-center">Dados Eclesiásticos</h5>
                <hr class="mt-2 mb-3"/>
            </div>

            @if($membro->numero_rol)
                <div>
                    <b>ROL: </b>{{ $membro->numero_rol}}<br>
                </div>
            @endif
            @if($membro->tipo_membro)
                <div>
                    <b>Tipo de Membro: </b>{{ $membro->descricao_tipo_membro}}<br>
                </div>
            @endif
            @if($membro->status_participacao_id)
                <div>
                    <b>Status de Participação: </b>{{ $membro->status_participacao->nome}}<br>
                </div>
            @endif
            @if($membro->is_disciplina)
                <div>
                    <b>Está em Disciplina ?: </b>{{ $membro->descricao_is_disciplina}}<br>
                </div>
            @endif
            @if($membro->data_batismo)
                <div>
                    <b>Data Batismo: </b>{{ $membro->data_batismo_formatada}}<br>
                </div>
            @endif
            @if($membro->pastor_batismo)
                <div>
                    <b>Pastor Batismo: </b>{{ $membro->pastor_batismo}}<br>
                </div>
            @endif
            @if($membro->igreja_batismo)
                <div>
                    <b>Igreja Batismo: </b>{{ $membro->igreja_batismo}}<br>
                </div>
            @endif
            @if($membro->data_profissao_fe)
                <div>
                    <b>Data Profissão de Fé: </b>{{ $membro->data_profissao_fe_formatada}}<br>
                </div>
            @endif
            @if($membro->pastor_profissao_fe)
                <div>
                    <b>Pastor Profissão de Fé: </b>{{ $membro->pastor_profissao_fe}}<br>
                </div>
            @endif
            @if($membro->igreja_profissao_fe)
                <div>
                    <b>Igreja Profissão de Fé: </b>{{ $membro->igreja_profissao_fe}}<br>
                </div>
            @endif
            @if($membro->igreja_old_nome)
                <div>
                    <b>Igreja Anterior: </b>{{ $membro->igreja_old_nome}}<br>
                </div>
            @endif
            @if($membro->igreja_old_cidade)
                <div>
                    <b>Cidade/UF Igreja Anterior: </b>{{ $membro->igreja_old_cidade}}<br>
                </div>
            @endif
            @if($membro->igreja_old_pastor)
                <div>
                    <b>Pastor Igreja Anterior: </b>{{ $membro->igreja_old_pastor}}<br>
                </div>
            @endif
            @if($membro->igreja_old_pastor_email)
                <div>
                    <b>E-mail Pastor Igreja Anterior: </b>{{ $membro->igreja_old_pastor_email}}<br>
                </div>
            @endif
            @if($membro->numero_ata)
                <div>
                    <b>Número da Ata: </b>{{ $membro->numero_ata}}<br>
                </div>
            @endif
            @if($membro->data_admissao)
                <div>
                    <b>Data de Admissão: </b>{{ $membro->data_admissao_formatada}}<br>
                </div>
            @endif
            @if($membro->meio_admissao_id)
                <div>
                    <b>Meio de Admissao: </b>{{ $membro->meio_admissao->nome}}<br>
                </div>
            @endif
            @if($membro->data_demissao)
                <div>
                    <b>Data de Demissão: </b>{{ $membro->data_demissao_formatada}}<br>
                </div>
            @endif
            @if($membro->meio_demissao)
                <div>
                    <b>Meio de Demissão: </b>{{ $membro->meio_demissao}}<br>
                </div>
            @endif

            <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                <hr class="mt-2 mb-3"/>
                <h5 class="text-center">Dados Ministeriais</h5>
                <hr class="mt-2 mb-3"/>
            </div>

            @if($membro->membro_ministerios)
                <div>
                    <b>Ministérios: </b>
                    @foreach($membro->membro_ministerios as $membro_ministerio)
                        {{ $membro_ministerio->ministerio->nome}},
                    @endforeach
                </div>
            @endif
            @if($membro->aptidao)
                <div>
                    <b>Aptidões: </b>{{ $membro->aptidao}}<br>
                </div>
            @endif


            <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                <hr class="mt-2 mb-3"/>
                <h5 class="text-center">Dados Acesso</h5>
                <hr class="mt-2 mb-3"/>
            </div>

            @if($membro->user)
                <div>
                    <b>Status: </b>{{ ($membro->user->situacao['status'] == 'A') ? 'Ativo' : 'Inativo'}}<br>
                </div>

                <div>
                    <b>Perfil: </b>{{ $membro->user->perfil}}<br>
                </div>

                <div>
                    <b>Login: </b>{{ $membro->user->email}}<br>
                </div>
            @endif

            </div>
        </div>
    </div>
</div>

</body>
</html>
