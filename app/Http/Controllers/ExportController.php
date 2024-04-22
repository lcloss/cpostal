<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ExportDataJob;

class ExportController extends Controller
{
    public function index()
    {
        return view('export.index');
    }

    public function export(Request $request)
    {
        $tipo = $request->tipo;
        $distrito_id = $request->distrito;
        $formato = $request->formato;
        $path = 'exports/';
        $filename = $tipo;
        
        // ... existing code ...
        
        if ( Storage::exists( $path . $filename) ) {
            return Storage::download( $path . $filename, $filename);
        } else {
            $max_execution_time = ini_get('max_execution_time');
            // Set max execution time to 10 minutes
            $ten_minutes = 10 * 60;
            set_time_limit($ten_minutes);
            
            // Create a new job instance and dispatch it
            dispatch(new ExportDataJob($tipo, $distrito_id, $formato, $path, $filename));
            
            // Restore max execution time
            set_time_limit($max_execution_time);
        }
    }

    public function export(Request $request)
    {
        $tipo = $request->tipo;
        $distrito_id = $request->distrito;
        $formato = $request->formato;

        $path = 'exports/';
        $filename = $tipo;

        if ( !empty( $distrito_id ) ) {
            $concelho_id = $request->concelho;

            $distrito = Distrito::find($distrito_id);
            $filename .= '_' . Str::slug($distrito->nome);

            if ( !empty( $concelho_id ) ) {
                $concelho = Concelho::find($concelho_id);
                $filename .= '_' . Str::slug($concelho->nome);
            }
        }

        if ( $formato == 'csv' ) {
            $filename .= '.csv';
        } else {
            $filename .= '.xlsx';
        }

        if ( Storage::exists( $path . $filename) ) {
            return Storage::download( $path . $filename, $filename);
        } else {
            $max_execution_time = ini_get('max_execution_time');

            // Set max execution time to 10 minutes
            $ten_minutes = 10 * 60;
            set_time_limit($ten_minutes);

            if ( $tipo == 'codigos_postais' ) {
                if ( $formato == 'csv' ) {
                    // return $this->codigos_postais_export_csv($distrito_id, $filename);
                    Excel::store(new CodigosPostaisExport($distrito_id), $path . $filename, \Maatwebsite\Excel\Excel::CSV);
                    return ( new CodigosPostaisExport($distrito_id) )->download($filename);
                } else {
                    Excel::store(new CodigosPostaisExport($distrito_id), $path . $filename, \Maatwebsite\Excel\Excel::XLSX);
                    return ( new CodigosPostaisExport($distrito_id) )->download($filename);
                }
            } else {
                if ( $formato == 'csv') {
                    // return $this->apartados_export_csv($filename);
                    Excel::store(new ApartadosExport, $path . $filename, \Maatwebsite\Excel\Excel::CSV);
                    return ( new ApartadosExport )->download($filename);
                } else {
                    Excel::store(new ApartadosExport, $path . $filename, \Maatwebsite\Excel\Excel::XLSX);
                    return ( new ApartadosExport )->download($filename);
                }
            }

            // Restore max execution time
            set_time_limit($max_execution_time);
        }
    }
}
