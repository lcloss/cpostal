<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Models\Concelho;
use App\Models\Localidade;
use App\Models\CodigoPostal;

class CodigoPostalController extends Controller
{
    public function index()
    {
        $distritos = Distrito::orderBy('nome')->get();
        $concelhos = [];
        $localidades = [];

        return view('index', compact('distritos', 'concelhos', 'localidades'));
    }

    public function search()
    {
        return redirect()->route('home');
    }

    public function export()
    {
        $ten_minutes = 20 * 60;

        set_time_limit($ten_minutes);

        $codigos_postais = CodigoPostal::orderBy('cpost_4')->orderBy('cpost_3')->get();

        $header = [
            'Distrito',
            'Concelho',
            'Localidade',
            'Código Postal',
            'Descritivo',
            'Arruamento',
            'Troço',
        ];

        $filename = 'codigospostais_' . date('Y_m_d') . '.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, $header);

        $distrito_id = 0;
        $distrito = '';
        $concelho_id = 0;
        $concelho = '';
        $localidade_id = 0;
        $localidade = '';

        foreach( $codigos_postais as $codigo_postal ) {
            if ( $distrito_id != $codigo_postal->concelho->distrito_id ) {
                $distrito_id = $codigo_postal->concelho->distrito_id;
                $distrito = $codigo_postal->concelho->distrito->nome;
            }
            if ( $concelho_id != $codigo_postal->concelho_id ) {
                $concelho_id = $codigo_postal->concelho_id;
                $concelho = $codigo_postal->concelho->nome;
            }
            if ( $localidade_id != $codigo_postal->localidade_id ) {
                $localidade_id = $codigo_postal->localidade_id;
                $localidade = $codigo_postal->localidade->nome;
            }

            $data = [
                $distrito,
                $concelho,
                $localidade,
                $codigo_postal->codigo_postal,
                $codigo_postal->descritivo_postal,
                $codigo_postal->logradouro,
                $codigo_postal->troco,
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
