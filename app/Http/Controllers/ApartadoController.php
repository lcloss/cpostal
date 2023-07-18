<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartado;

class ApartadoController extends Controller
{
    public function index()
    {
        return view('apartados.index');
    }

    public function export()
    {
        $ten_minutes = 20 * 60;

        set_time_limit($ten_minutes);

        $apartados = Apartado::orderBy('cpost_4')->orderBy('cpost_3')->get();

        $header = [
            'Tipo',
            'Denominação',
            'Código Postal',
            'Descritivo',
        ];

        $filename = 'apartados_' . date('Y_m_d') . '.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, $header);

        foreach( $apartados as $apartado ) {
            $data = [
                $apartado->tipo,
                $apartado->denominacao,
                $apartado->codigo_postal,
                $apartado->descritivo_postal,
            ];
            fputcsv($handle, $data);
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        set_time_limit(60);

        return response()->download($filename, $filename, $headers);
    }

}
