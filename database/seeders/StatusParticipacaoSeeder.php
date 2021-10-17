<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusParticipacaoSeeder extends Seeder
{

    public function run()
    {

        if(DB::table('status_participacaos')->get()->count() == 0){

            DB::table('status_participacaos')->insert([
                [
                    'id' => 1,
                    'nome' => 'Sede IPC',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'nome' => 'Não Residente',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'nome' => 'Rol Separado',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);

        } else { echo "\e[31mTabela status_participacaos não está vazia. "; }

    }

}
