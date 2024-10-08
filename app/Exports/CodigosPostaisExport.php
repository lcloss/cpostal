<?php

namespace App\Exports;

use App\Models\CodigoPostal;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class CodigosPostaisExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public $distrito_id;

    public function __construct( $distrito_id = '' )
    {
        $this->distrito_id = $distrito_id;
    }

    public function headings(): array
    {
        return [
            'Distrito',
            'Concelho',
            'Localidade',
            'Código Postal',
            'Descritivo',
            'Arruamento',
            'Troço',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
//        $query = CodigoPostal::query()
//            ->join('distritos', 'distritos.id', '=', 'codigo_postals.distrito_id')
//            ->join('concelhos', 'concelhos.id', '=', 'codigo_postals.concelho_id')
//            ->join('localidades', 'localidades.id', '=', 'codigo_postals.localidade_id')
//            ->select('distritos.nome as distrito', 'concelhos.nome as concelho', 'localidades.nome as localidade', 'codigo_postals.cpost_4', 'codigo_postals.cpost_3', 'codigo_postals.descritivo_postal', 'codigo_postals.logradouro', 'codigo_postals.troco');
        $query = CodigoPostal::select('distritos.nome as distrito', 'concelhos.nome as concelho', 'localidades.nome as localidade', 'codigo_postals.cpost_4', 'codigo_postals.cpost_3', 'codigo_postals.descritivo_postal', 'codigo_postals.logradouro', 'codigo_postals.troco')
            ->join('distritos', 'distritos.id', '=', 'codigo_postals.distrito_id')
            ->join('concelhos', 'concelhos.id', '=', 'codigo_postals.concelho_id')
            ->join('localidades', 'localidades.id', '=', 'codigo_postals.localidade_id')
            ->when( $this->distrito_id != '', function ($q) {
                return $q->where('codigo_postals.distrito_id', $this->distrito_id);
            })
            ->orderBy('codigo_postals.cpost_4')->orderBy('codigo_postals.cpost_3');

        // dd( $query );

//        if ( !empty( $this->distrito_id ) ) {
//            $query->where('codigo_postals.distrito_id', $this->distrito_id);
//        }
//
//        $query->orderBy('codigo_postals.cpost_4')->orderBy('codigo_postals.cpost_3');

        return $query;
    }

    public function map($codigo_postal): array
    {
        return [
            $codigo_postal->distrito,
            $codigo_postal->concelho,
            $codigo_postal->localidade,
            $codigo_postal->cpost_4 . '-' . $codigo_postal->cpost_3,
            $codigo_postal->descritivo_postal,
            $codigo_postal->logradouro,
            $codigo_postal->troco,
        ];
    }
}
