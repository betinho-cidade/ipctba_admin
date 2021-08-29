<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacaoMembroSeeder extends Seeder
{

    public function run()
    {

        if(DB::table('situacao_membros')->get()->count() == 0){

            DB::table('situacao_membros')->insert([
                [
                    'id' => 1,
                    'nome' => 'Cadastro Site',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);

        } else { echo "\e[31mTabela situacao_membros não está vazia. "; }

    }

}
