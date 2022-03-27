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

<body style="font-size: 10px">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 style="color:#575757;font-size: 14px">Relatório do Membro</h4>
            <p>Informações do membro {{ strtoupper($membro->nome) }} dispostas em formato PDF para armazenamento e impressão.</p>


            <div class="bg-soft-primary">
                <h5 style="font-size: 12px" class="text-left">Dados Pessoais</h5>
                <hr class="mt-1 mb-1"/>
            </div>

            @if($membro->nome)
            <div class="bg-soft-primary">
                <b>Nome: </b>{{ $membro->nome }}<br>
            </div>
            @endif

            @if($membro->email)
            <div class="bg-soft-primary">
                <b>E-mail: </b>{{ $membro->email }}<br>
            </div>
            @endif

            @if($membro->cpf)
            <div class="bg-soft-primary">
                <b>Cpf: </b>{{ $membro->cpf }}<br>
            </div>
            @endif

            @if($membro->sexo)
            <div class="bg-soft-primary">
                <b>Sexo: </b>{{ $membro->descricao_sexo }}<br>
            </div>
            @endif

            @if($membro->celular)
            <div class="bg-soft-primary">
                <b>Celular: </b>{{ $membro->celular}}<br>
            </div>
            @endif

            @if($membro->data_nascimento)
            <div class="bg-soft-primary">
                <b>Data Nascimento: </b>{{ $membro->data_nascimento_formatada}}<br>
            </div>
            @endif

            @if($membro->naturalidade)
            <div class="bg-soft-primary">
                <b>Naturalidade: </b>{{ $membro->naturalidade}}<br>
            </div>
            @endif

            <div class="bg-soft-primary" style="margin-top: 15px;">
                <h5 style="font-size: 12px" class="text-left">Dados Complementares</h5>
                <hr class="mt-1 mb-1"/>
            </div>

            @if($membro->situacao)
                <div class="bg-soft-primary">
                    <b>Status: </b>{{ $membro->descricao_situacao}}<br>
                </div>
            @endif

            @if($membro->estado_civil)
                <div class="bg-soft-primary">
                    <b>Estado Civil: </b>{{ $membro->descricao_estado_civil }}<br>
                </div>
            @endif

            @if($membro->conjuge)
                <div class="bg-soft-primary">
                    <b>Cônjuge: </b>{{ $membro->conjuge }}<br>
                </div>
            @endif

            @if($membro->data_casamento)
                <div class="bg-soft-primary">
                    <b>Data Casamento: </b>{{ $membro->data_casamento_formatada }}<br>
                </div>
            @endif

            @if($membro->escolaridade)
                <div class="bg-soft-primary">
                    <b>Escolaridade: </b>{{ $membro->descricao_escolaridade }}<br>
                </div>
            @endif

            @if($membro->profissao)
                <div class="bg-soft-primary">
                    <b>Profissão: </b>{{ $membro->profissao }}<br>
                </div>
            @endif

            @if($membro->nome_pai)
                <div class="bg-soft-primary">
                    <b>Nome do Pai: </b>{{ $membro->nome_pai }}<br>
                </div>
            @endif

            @if($membro->nome_mae)
                <div class="bg-soft-primary">
                    <b>Nome da Mãe: </b>{{ $membro->nome_mae }}<br>
                </div>
            @endif

            <div class="bg-soft-primary" style="margin-top: 15px;">
                <h5 style="font-size: 12px" class="text-left">Dados Endereço</h5>
                <hr class="mt-1 mb-1"/>
            </div>

            @if($membro->end_cep)
                <div class="bg-soft-primary">
                    <b>CEP: </b>{{ $membro->end_cep}}<br>
                </div>
            @endif

            @if($membro->end_cidade)
                <div class="bg-soft-primary">
                    <b>Cidade: </b>{{ $membro->end_cidade}}<br>
                </div>
            @endif

            @if($membro->end_uf)
                <div class="bg-soft-primary">
                    <b>UF: </b>{{ $membro->end_uf}}<br>
                </div>
            @endif

            @if($membro->end_bairro)
                <div class="bg-soft-primary">
                    <b>Bairro: </b>{{ $membro->end_bairro}}<br>
                </div>
            @endif

            @if($membro->end_logradouro)
                <div class="bg-soft-primary">
                    <b>Endereço: </b>{{ $membro->end_logradouro}}<br>
                </div>
            @endif

            @if($membro->end_numero)
                <div class="bg-soft-primary">
                    <b>Número: </b>{{ $membro->end_numero}}<br>
                </div>
            @endif

            @if($membro->end_complemento)
                <div class="bg-soft-primary">
                    <b>Complemento: </b>{{ $membro->end_complemento}}<br>
                </div>
            @endif

            <div class="bg-soft-primary" style="margin-top: 15px;">
                <h5 style="font-size: 12px" class="text-left">Dados Eclesiásticos</h5>
                <hr class="mt-1 mb-1"/>
            </div>

            @if($membro->numero_rol)
                <div class="bg-soft-primary">
                    <b>ROL: </b>{{ $membro->numero_rol}}<br>
                </div>
            @endif
            @if($membro->tipo_membro)
                <div class="bg-soft-primary">
                    <b>Tipo de Membro: </b>{{ $membro->descricao_tipo_membro}}<br>
                </div>
            @endif
            @if($membro->status_participacao_id)
                <div class="bg-soft-primary">
                    <b>Status de Participação: </b>{{ $membro->status_participacao->nome}}<br>
                </div>
            @endif
            @if($membro->is_disciplina)
                <div class="bg-soft-primary">
                    <b>Está em Disciplina ?: </b>{{ $membro->descricao_is_disciplina}}<br>
                </div>
            @endif
            @if($membro->data_batismo)
                <div class="bg-soft-primary">
                    <b>Data Batismo: </b>{{ $membro->data_batismo_formatada}}<br>
                </div>
            @endif
            @if($membro->pastor_batismo)
                <div class="bg-soft-primary">
                    <b>Pastor Batismo: </b>{{ $membro->pastor_batismo}}<br>
                </div>
            @endif
            @if($membro->igreja_batismo)
                <div class="bg-soft-primary">
                    <b>Igreja Batismo: </b>{{ $membro->igreja_batismo}}<br>
                </div>
            @endif
            @if($membro->data_profissao_fe)
                <div class="bg-soft-primary">
                    <b>Data Profissão de Fé: </b>{{ $membro->data_profissao_fe_formatada}}<br>
                </div>
            @endif
            @if($membro->pastor_profissao_fe)
                <div class="bg-soft-primary">
                    <b>Pastor Profissão de Fé: </b>{{ $membro->pastor_profissao_fe}}<br>
                </div>
            @endif
            @if($membro->igreja_profissao_fe)
                <div class="bg-soft-primary">
                    <b>Igreja Profissão de Fé: </b>{{ $membro->igreja_profissao_fe}}<br>
                </div>
            @endif
            @if($membro->igreja_old_nome)
                <div class="bg-soft-primary">
                    <b>Igreja Anterior: </b>{{ $membro->igreja_old_nome}}<br>
                </div>
            @endif
            @if($membro->igreja_old_cidade)
                <div class="bg-soft-primary">
                    <b>Cidade/UF Igreja Anterior: </b>{{ $membro->igreja_old_cidade}}<br>
                </div>
            @endif
            @if($membro->igreja_old_pastor)
                <div class="bg-soft-primary">
                    <b>Pastor Igreja Anterior: </b>{{ $membro->igreja_old_pastor}}<br>
                </div>
            @endif
            @if($membro->igreja_old_pastor_email)
                <div class="bg-soft-primary">
                    <b>E-mail Pastor Igreja Anterior: </b>{{ $membro->igreja_old_pastor_email}}<br>
                </div>
            @endif
            @if($membro->numero_ata)
                <div class="bg-soft-primary">
                    <b>Número da Ata: </b>{{ $membro->numero_ata}}<br>
                </div>
            @endif
            @if($membro->data_admissao)
                <div class="bg-soft-primary">
                    <b>Data de Admissão: </b>{{ $membro->data_admissao_formatada}}<br>
                </div>
            @endif
            @if($membro->meio_admissao_id)
                <div class="bg-soft-primary">
                    <b>Meio de Admissao: </b>{{ $membro->meio_admissao->nome}}<br>
                </div>
            @endif
            @if($membro->data_demissao)
                <div class="bg-soft-primary">
                    <b>Data de Demissão: </b>{{ $membro->data_demissao_formatada}}<br>
                </div>
            @endif
            @if($membro->meio_demissao)
                <div class="bg-soft-primary">
                    <b>Meio de Demissão: </b>{{ $membro->meio_demissao}}<br>
                </div>
            @endif

            @if($membro->membro_ministerios)
                <div class="bg-soft-primary" style="margin-top: 15px;">
                    <h5 style="font-size: 12px" class="text-left">Dados Ministeriais</h5>
                    <hr class="mt-1 mb-1"/>
                </div>

                <div class="bg-soft-primary">
                    <b>Ministérios: </b>
                    @foreach($membro->membro_ministerios as $membro_ministerio)
                        {{ $membro_ministerio->ministerio->nome}},
                    @endforeach
                </div>

                @if($membro->aptidao)
                    <div class="bg-soft-primary">
                        <b>Aptidões: </b>{{ $membro->aptidao}}<br>
                    </div>
                @endif
            @endif

            @if($membro->user)
                <div class="bg-soft-primary" style="margin-top: 15px;">
                    <h5 style="font-size: 12px" class="text-left">Dados Acesso</h5>
                    <hr class="mt-1 mb-1"/>
                </div>

                <div class="bg-soft-primary">
                    <b>Status: </b>{{ ($membro->user->situacao['status'] == 'A') ? 'Ativo' : 'Inativo'}}<br>
                </div>

                <div class="bg-soft-primary">
                    <b>Perfil: </b>{{ $membro->user->perfil}}<br>
                </div>

                <div class="bg-soft-primary">
                    <b>Login: </b>{{ $membro->user->email}}<br>
                </div>
            @endif

            </div>
        </div>
    </div>
</div>

</body>
</html>
