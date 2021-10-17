<?php

namespace App\Imports;

use App\Models\Membro;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;


class MembrosImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

try{
        return new Membro([
           'nome'						=> $row['nome'],
            'end_cep'					=> Str::of($row['end_cep'])->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'end_cidade'				=> $row['end_cidade'],
            'end_uf'					=> $row['end_uf'],
            'end_logradouro'			=> $row['end_logradouro'],
            'end_numero'				=> $row['end_numero'],
            'end_bairro'				=> $row['end_bairro'],
            'end_complemento'			=> $row['end_complemento'],
            'celular'					=> Str::of($row['celular'])->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'data_nascimento'			=> ($row['data_nascimento']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_nascimento'])) : null,
            'naturalidade'				=> $row['naturalidade'],
            'sexo'						=> $row['sexo'],
            'estado_civil'				=> $row['estado_civil'],
            'conjuge'					=> $row['conjuge'],
            'data_casamento'			=> ($row['data_casamento']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_casamento'])) : null,
            'profissao'					=> $row['profissao'],
            'nome_pai'					=> $row['nome_pai'],
            'nome_mae'					=> $row['nome_mae'],
            'numero_rol'				=> $row['numero_rol'],
            'tipo_membro'				=> $row['tipo_membro'],
            'numero_ata'				=> $row['numero_ata'],
            'data_admissao'				=> ($row['data_admissao']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_admissao'])) : null,
            'status'					=> $row['status'],
            'meio_admissao_id'			=> ($row['meio_admissao_id']) ? $row['meio_admissao_id'] : null,
            'igreja_old_nome'			=> $row['igreja_old_nome'],
            'data_profissao_fe'			=> ($row['data_profissao_fe']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_profissao_fe'])) : null,
            'email'						=> $row['email'],
            'is_disciplina'				=> 'N',
            //'status_participacao_id'	=> ($row['status_participacao_id']) ? $row['status_participacao_id'] : null,
            'data_batismo'	    		=> ($row['data_batismo']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_batismo'])) : null,
            'pastor_batismo'    		=> $row['pastor_batismo'],
        ]);

    }catch(Exception $ex){
        dd($ex->getMessage(), $row);
    }

    }


    public function batchSize(): int
    {
        return 1024;
    }


    public function chunkSize(): int
    {
        return 1024;
    }
}
