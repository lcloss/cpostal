<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Distrito;
use App\Models\Concelho;
use App\Models\Localidade;
use App\Models\Apartado;
use App\Models\CodigoPostal;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CodigosPostaisExport;
use App\Exports\ApartadosExport;
use Illuminate\Support\Facades\Storage;

class CodigoPostalController extends Controller
{
    public function index(Request $request)
    {
        $distritos = Distrito::orderBy('nome')->get();
        $concelhos = [];
        $localidades = [];

        $cp = $request->input('cp');

        return view('index', compact('distritos', 'concelhos', 'localidades', 'cp'));
    }

    public function search()
    {
        return redirect()->route('home');
    }

    private function codigos_postais_export_csv($distrito, $filename)
    {
        $filename = 'codigospostais_' . date('Y_m_d') . '.csv';

        $codigos_postais = CodigoPostal::when($distrito, function(Builder $query, $distrito) {
            return $query->where('distrito_id', $distrito);

        })->orderBy('cpost_4')->orderBy('cpost_3')->get();

        $header = [
            'Distrito',
            'Concelho',
            'Localidade',
            'Código Postal',
            'Descritivo',
            'Arruamento',
            'Troço',
        ];

        $handle = fopen($filename, 'w+');
        fputcsv($handle, $header);

        $distrito_id = 0;
        $distrito = '';
        $concelho_id = 0;
        $concelho = '';
        $localidade_id = 0;
        $localidade = '';

        foreach( $codigos_postais as $codigo_postal ) {
            if ($distrito_id != $codigo_postal->concelho->distrito_id) {
                $distrito_id = $codigo_postal->concelho->distrito_id;
                $distrito = $codigo_postal->concelho->distrito->nome;
            }
            if ($concelho_id != $codigo_postal->concelho_id) {
                $concelho_id = $codigo_postal->concelho_id;
                $concelho = $codigo_postal->concelho->nome;
            }
            if ($localidade_id != $codigo_postal->localidade_id) {
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

        return response()->download($filename, $filename, $headers);
    }

    private function apartados_export_csv()
    {
        $filename = 'apartados_' . date('Y_m_d') . '.csv';
        $apartados = Apartado::orderBy('cpost_4')->orderBy('cpost_3')->get();

        $header = [
            'Tipo',
            'Denominação',
            'Código Postal',
            'Descritivo',
        ];

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

        return response()->download($filename, $filename, $headers);
    }

    public function all()
    {
        return view('codigos_postais.index');
    }

    public function aleatorio()
    {
        return view('codigos_postais.aleatorio');
    }
}
