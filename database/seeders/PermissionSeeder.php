<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        if (DB::table('permissions')->get()->count() == 0) {

            DB::table('permissions')->insert([
                [
                    'id' => 1,
                    'name' => 'view_painel',
                    'description' => 'Acessar o painel do sistema Ipctba',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'view_usuario',
                    'description' => 'Acessar as informações dos Usuários do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'edit_usuario',
                    'description' => 'Alterar as informações dos Usuários do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'create_usuario',
                    'description' => 'Criar um novo Usuário do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'delete_usuario',
                    'description' => 'Excluir um Usuário do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'view_status_participacao',
                    'description' => 'Acessar as informações dos Status de Participação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'edit_status_participacao',
                    'description' => 'Alterar as informações dos Status de Participação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'name' => 'create_status_participacao',
                    'description' => 'Criar um novo Status de Participação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 9,
                    'name' => 'delete_status_participacao',
                    'description' => 'Excluir um Status de Participação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 10,
                    'name' => 'view_meio_admissao',
                    'description' => 'Acessar as informações dos Meios de Admissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 11,
                    'name' => 'edit_meio_admissao',
                    'description' => 'Alterar as informações dos Meios de Admissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 12,
                    'name' => 'create_meio_admissao',
                    'description' => 'Criar um novo Meio de Admissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 13,
                    'name' => 'delete_meio_admissao',
                    'description' => 'Excluir um Meios de Admissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 14,
                    'name' => 'view_meio_demissao',
                    'description' => 'Acessar as informações dos Meios de Demissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 15,
                    'name' => 'edit_meio_demissao',
                    'description' => 'Alterar as informações dos Meios de Demissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 16,
                    'name' => 'create_meio_demissao',
                    'description' => 'Criar um novo Meio de Demissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 17,
                    'name' => 'delete_meio_demissao',
                    'description' => 'Excluir um Meios de Demissão do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 18,
                    'name' => 'view_oficio',
                    'description' => 'Acessar as informações dos Ofícios do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 19,
                    'name' => 'edit_oficio',
                    'description' => 'Alterar as informações dos Ofícios do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 20,
                    'name' => 'create_oficio',
                    'description' => 'Criar um novo Ofício do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 21,
                    'name' => 'delete_oficio',
                    'description' => 'Excluir um Ofício do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 22,
                    'name' => 'view_ministerio',
                    'description' => 'Acessar as informações dos Ministérios do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 23,
                    'name' => 'edit_ministerio',
                    'description' => 'Alterar as informações dos Ministérios do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 24,
                    'name' => 'create_ministerio',
                    'description' => 'Criar um novo Ministério do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 25,
                    'name' => 'delete_ministerio',
                    'description' => 'Excluir um Ministério do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 26,
                    'name' => 'view_situacao_membro',
                    'description' => 'Acessar as informações das Situações dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 27,
                    'name' => 'edit_situacao_membro',
                    'description' => 'Alterar as informações das Situações dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 28,
                    'name' => 'create_situacao_membro',
                    'description' => 'Criar uma nova Situação do Membro do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 29,
                    'name' => 'delete_situacao_membro',
                    'description' => 'Excluir uma Situação do Membro do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 30,
                    'name' => 'view_tipo_solicitacao',
                    'description' => 'Acessar as informações dos Tipos de Solicitações do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 31,
                    'name' => 'edit_tipo_solicitacao',
                    'description' => 'Alterar as informações dos Tipos de Solicitações do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 32,
                    'name' => 'create_tipo_solicitacao',
                    'description' => 'Criar um novo Tipo de Solicitação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 33,
                    'name' => 'delete_tipo_solicitacao',
                    'description' => 'Excluir um Tipo de Solicitação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 34,
                    'name' => 'view_membro',
                    'description' => 'Acessar as informações dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 35,
                    'name' => 'edit_membro',
                    'description' => 'Alterar as informações dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 36,
                    'name' => 'create_membro',
                    'description' => 'Criar um novo Membro do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 37,
                    'name' => 'delete_membro',
                    'description' => 'Excluir um Membro do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 38,
                    'name' => 'view_historico_oficio',
                    'description' => 'Acessar as informações dos Históricos de Ofícios do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 39,
                    'name' => 'edit_historico_oficio',
                    'description' => 'Alterar as informações dos Históricos de Ofícios do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 40,
                    'name' => 'create_historico_oficio',
                    'description' => 'Criar um novo Histórico de Ofícios do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 41,
                    'name' => 'delete_historico_oficio',
                    'description' => 'Excluir um Histórico de Ofícios do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 42,
                    'name' => 'view_historico_situacao',
                    'description' => 'Acessar as informações dos Históricos de Situações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 43,
                    'name' => 'edit_historico_situacao',
                    'description' => 'Alterar as informações dos Históricos de Situações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 44,
                    'name' => 'create_historico_situacao',
                    'description' => 'Criar um novo Histórico de Situações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 45,
                    'name' => 'delete_historico_situacao',
                    'description' => 'Excluir um Histórico de Situações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 46,
                    'name' => 'view_historico_solicitacao',
                    'description' => 'Acessar as informações dos Históricos de Solicitações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 47,
                    'name' => 'edit_historico_solicitacao',
                    'description' => 'Alterar as informações dos Históricos de Solicitações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 48,
                    'name' => 'create_historico_solicitacao',
                    'description' => 'Criar um novo Histórico de Solicitações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 49,
                    'name' => 'delete_historico_solicitacao',
                    'description' => 'Excluir um Histórico de Solicitações do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 50,
                    'name' => 'view_historico_familiar',
                    'description' => 'Acessar as informações dos Históricos Familiares dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 51,
                    'name' => 'edit_historico_familiar',
                    'description' => 'Alterar as informações dos Históricos Familiares dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 52,
                    'name' => 'create_historico_familiar',
                    'description' => 'Criar uma nova dos Históricos Familiares dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 53,
                    'name' => 'delete_historico_familiar',
                    'description' => 'Excluir um Histórico Familiar dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 54,
                    'name' => 'view_membro_ficha',
                    'description' => 'Acessar as informações das Fichas de Atualização dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 55,
                    'name' => 'edit_membro_ficha',
                    'description' => 'Alterar as informações das Fichas de Atualização dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 56,
                    'name' => 'create_membro_ficha',
                    'description' => 'Criar uma nova das Fichas de Atualização dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 57,
                    'name' => 'delete_membro_ficha',
                    'description' => 'Excluir uma Ficha de Atualização dos Membros do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 58,
                    'name' => 'view_agenda',
                    'description' => 'Acessar as informações das solicitações em formato de agenda',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 59,
                    'name' => 'view_relatorio',
                    'description' => 'Acessar as informações dos membros em formato de relatório',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 60,
                    'name' => 'view_indicador',
                    'description' => 'Acessar as informações dos indicadores do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 61,
                    'name' => 'view_usuario_logado',
                    'description' => 'Acessar as informações do usuário logado',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 62,
                    'name' => 'view_agenda_solicitacao',
                    'description' => 'Acessar as informações das Agendas/Solicitações do membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 63,
                    'name' => 'edit_agenda_solicitacao',
                    'description' => 'Alterar as informações das Agendas/Solicitações do membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 64,
                    'name' => 'create_agenda_solicitacao',
                    'description' => 'Criar uma nova Agenda/Solicitação do membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 65,
                    'name' => 'delete_agenda_solicitacao',
                    'description' => 'Excluir uma Agenda/Solicitação do membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 66,
                    'name' => 'view_processo_visitante',
                    'description' => 'Acessar as informações das Solicitações/Processos dos visitantes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 67,
                    'name' => 'edit_processo_visitante',
                    'description' => 'Alterar as informações das Solicitações/Processos dos visitantes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 68,
                    'name' => 'create_processo_visitante',
                    'description' => 'Criar uma nova Solicitação/Processo do visitante',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 69,
                    'name' => 'delete_processo_visitante',
                    'description' => 'Excluir uma Solicitação/Processo do visitante',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],    
                [
                    'id' => 70,
                    'name' => 'view_ficha_visitante',
                    'description' => 'Acessar as informações das Fichas dos visitantes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 71,
                    'name' => 'edit_ficha_visitante',
                    'description' => 'Alterar as informações das Fichas dos visitantes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 72,
                    'name' => 'create_ficha_visitante',
                    'description' => 'Criar uma nova Ficha do visitante',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 73,
                    'name' => 'delete_ficha_visitante',
                    'description' => 'Excluir uma Ficha do visitante',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],  
                [
                    'id' => 74,
                    'name' => 'assign_ficha_visitante',
                    'description' => 'Gerenciar Lider como responsável da Ficha do visitante',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],                                    

            ]);
        } else {
            echo "\e[31mTabela Permissions não está vazia. ";
        }
    }
}
