<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCodigoPostalExportFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $tipo;
    public int $distrito_id;
    public int $concelho_id;
    public string $formato;
    public string $path;
    public string $filename;

    /**
     * Create a new job instance.
     */
    public function __construct(string $tipo, int $distrito_id, int $concelho_id, string $formato)
    {
        $this->tipo = $tipo;
        $this->distrito_id = $distrito_id;
        $this->concelho_id = $concelho_id;
        $this->formato = $formato;

        $this->path = 'exports/';
        $this->filename = $this->tipo;
        if ( $this->distrito_id != 0 ) {
            $distrito = Distrito::find($this->distrito_id);
            $this->filename .= '_' . Str::slug($distrito->nome);

            if ( $this->concelho_id != 0 ) {
                $concelho = Concelho::find($this->concelho_id);
                $this->filename .= '_' . Str::slug($concelho->nome);
            }
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
