<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CodigosPostaisExport;
use App\Exports\ApartadosExport;
use App\Models\Distrito;
use Illuminate\Support\Str;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class GenerateExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $filename;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $tipo,
        public string $formato,
        public string $distrito_id,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = 'exports/';
        $filename = $this->tipo;

        if ( !empty( $this->distrito_id ) ) {
            $distrito = Distrito::find($this->distrito_id);
            $filename .= '_' . Str::slug($distrito->nome);
        }

        if ( $this->formato == 'csv' ) {
            $filename .= '.csv';
        } else {
            $filename .= '.xlsx';
        }
        $this->filename = $filename;
        $full_filename = $path . $filename;

        if ( Storage::exists( $full_filename) ) {
            // return Storage::download( $full_filename, $this->filename );
            // return response()->download( $full_filename, $this->filename );
            session()->flash('info', 'Exportação concluída. Faça <a href="' . route('download', ['file' => $filename]) . '">download do ficheiro</a>.');
        } else {
            if ( $this->tipo == 'codigos_postais' ) {
                if ( $this->formato == 'csv' ) {
                    Excel::store(new CodigosPostaisExport($this->distrito_id), $full_filename, 'local', \Maatwebsite\Excel\Excel::CSV);
                } else {
                    Excel::store(new CodigosPostaisExport($this->distrito_id), $full_filename, 'local', \Maatwebsite\Excel\Excel::XLSX);
                }
            } else {
                if ( $this->formato == 'csv') {
                    Excel::store(new ApartadosExport, $full_filename, 'local', \Maatwebsite\Excel\Excel::CSV);
                } else {
                    Excel::store(new ApartadosExport, $full_filename, 'local', \Maatwebsite\Excel\Excel::XLSX);
                }
            }
            // return Storage::download( $full_filename, $this->filename );
//            return response()->download( $full_filename, $this->filename );
            session()->flash('info', 'Exportação concluída. Faça <a href="' . route('download', ['file' => $filename]) . '">download do ficheiro</a>.');
        }

    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [new WithoutOverlapping($this->filename)];
    }
}
