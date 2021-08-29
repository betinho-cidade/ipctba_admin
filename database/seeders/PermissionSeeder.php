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
                    'name' => 'view_local_congrega',
                    'description' => 'Acessar as informações dos Locais de Congregação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'edit_local_congrega',
                    'description' => 'Alterar as informações dos Locais de Congregação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'name' => 'create_local_congrega',
                    'description' => 'Criar um novo Local de Congregação do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 9,
                    'name' => 'delete_local_congrega',
                    'description' => 'Excluir um Local de Congregação do sistema',
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
                    'name' => 'view_historico',
                    'description' => 'Acessar as informações dos Históricos do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 39,
                    'name' => 'edit_historico',
                    'description' => 'Alterar as informações dos Históricos do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 40,
                    'name' => 'create_historico',
                    'description' => 'Criar um novo Histórico do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 41,
                    'name' => 'delete_historico',
                    'description' => 'Excluir um Histórico do Membro',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31mTabela Permissions não está vazia. ";
        }
    }
}
