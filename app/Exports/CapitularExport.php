<?php

namespace App\Exports;

use App\Models\Capitular;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class CapitularExport implements FromCollection, WithMapping, WithHeadings
{

    public function __construct()
    {
    }


    public function headings(): array
    {
        return [
            'ID',
            'Idioma Site',
            'Data Cadastro',
            'Idioma Formulário',
            'Território',
            'Nome',
            'Celular',
            'Data Nascimento',
            'Profissão',
            'Idioma',
            'Data Casamento',
            'Filho',
            'Endereço',
            'E-mail',
            'Foto Família 01',
            'Foto Família 02',
            'Foto Família 03',
            'Data União Família',
            'Curso',
            'Ideal de Curso',
            'Ano Consagração',
            'Santuário',
            'Apostolado',
            'Desejo do Casal',
            'Palavra',
            'Frase',
            'Expectativa',
        ];
    }

    public function map($capitular): array
    {

        return [
            $capitular->capitular_agrupador_id,
            $capitular->capitular_agrupador->idioma_site->nome,
            Date::stringToExcel($capitular->capitular_agrupador->data_cadastro_formatada),
            $capitular->idioma_form->nome,
            $capitular->paise->nome,
            $capitular->nome,
            $capitular->celular,
            $capitular->data_nascimento,
            $capitular->profissao,
            $capitular->idioma,
            $capitular->data_casamento,
            $capitular->filho,
            $capitular->endereco,
            $capitular->email,
            $capitular->imagem_familia1,
            $capitular->imagem_familia2,
            $capitular->imagem_familia3,
            $capitular->data_uniao_familia,
            $capitular->curso,
            $capitular->ideal_curso,
            $capitular->ano_consagracao,
            $capitular->santuario,
            $capitular->apostolado,
            $capitular->desejo_casal,
            $capitular->palavra,
            $capitular->frase,
            $capitular->expectativa,
        ];

    }

    public function collection()
    {

        $capitulars = Capitular::get();

        return $capitulars;
    }


}
