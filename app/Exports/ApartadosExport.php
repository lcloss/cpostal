<?php

namespace App\Exports;

use App\Models\Apartado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class ApartadosExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Tipo',
            'Denominação',
            'Código Postal',
            'Descritivo',
        ];
    }

    public function map($codigo_postal): array
    {
        return [
            $codigo_postal->tipo,
            $codigo_postal->denominacao,
            $codigo_postal->cpost_4 . '-' . $codigo_postal->cpost_3,
            $codigo_postal->descritivo_postal,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Apartado::select(['tipo', 'denominacao', 'cpost_4', 'cpost_3', 'descritivo_postal'])->orderBy('cpost_4')->orderBy('cpost_3')->get();
    }
}
