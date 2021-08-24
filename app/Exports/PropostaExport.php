<?php

namespace App\Exports;

use App\Models\Proposta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class PropostaExport implements  FromCollection, WithMapping, WithHeadings
{
    public function __construct()
    {
    }

    public function headings(): array
    {
        return [
            'ID',
            'Idioma Site',
            'Tipo Proposta',
            'Data Cadastro',
            'Idioma Formulário',
            'País',
            'Autor',
            'Data',
            'Título',
            'Texto',
            'Fundamentação',
            'Comentário',
            'E-mail',
        ];
    }

    public function map($proposta): array
    {

        return [
            $proposta->proposta_agrupador_id,
            $proposta->proposta_agrupador->idioma_site->nome,
            $proposta->proposta_agrupador->tipo_proposta->nome ?? ' --- ',
            Date::stringToExcel($proposta->proposta_agrupador->data_cadastro_formatada),
            $proposta->idioma_form->nome,
            $proposta->paise->nome,
            $proposta->autor,
            Date::stringToExcel($proposta->data_formatada),
            $proposta->titulo,
            $proposta->texto,
            $proposta->fundamentacao,
            $proposta->comentario,
            $proposta->email,
        ];

    }

    public function collection()
    {

        $propostas = Proposta::get();

        return $propostas;
    }


}
