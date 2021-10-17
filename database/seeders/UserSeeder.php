<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    public function run()
    {

        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'Gestor do Ipctba',
                    'email' => 'gestor',
                    'password' => bcrypt('12345678'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'Lider do Ipctba',
                    'email' => 'lider',
                    'password' => bcrypt('12345678'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);

        } else { echo "\e[31mTabela Users não está vazia. "; }

    }
}

