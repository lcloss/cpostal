<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Distrito;
use App\Models\Concelho;
use App\Models\Localidade;
use App\Models\CodigoPostal;

class CodigoPostalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($open = fopen(storage_path() . "/csv/todos_cp.txt", "r")) !== FALSE) {

            $last_distrito = '';
            $last_concelho = '';
            $last_localidade = '';

            $count = 0;

            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                if ( $last_distrito != $data[0] || $last_concelho != $data[1] || $last_localidade != $data[2] || $last_localidade == '' ) {
                    if ( $last_distrito != $data[0] ) {
                        $distrito = Distrito::where('codigo', $data[0])->first();
                    }

                    if ( $last_distrito != $data[0] || $last_concelho != $data[1] ) {
                        $concelho = Concelho::where('distrito_id', $distrito->id)->where('codigo', $data[1])->first();
                    }

                    if ( $last_distrito != $data[0] || $last_concelho != $data[1] || $last_localidade != $data[2] || $last_localidade == '' ) {
                        $last_distrito = $data[0];
                        $last_concelho = $data[1];
                        $last_localidade = $data[2];

                        $localidade = Localidade::where('concelho_id', $concelho->id)->where('codigo', $data[2])->first();

                        if ( is_null( $localidade )  ) {
                            $localidade_data = [
                                'distrito_id'       => $distrito->id,
                                'concelho_id'       => $concelho->id,
                                'codigo_distrito'   => $data[0],
                                'codigo_concelho'   => $data[1],
                                'codigo'            => $data[2],
                                'nome'              => $data[3],
                            ];

                            Localidade::insertOrIgnore($localidade_data);

                            $localidade = Localidade::where('concelho_id', $concelho->id)->where('codigo', $data[2])->first();
                        }
                    }
                }

                if ( is_null( $localidade ) ) {
                    echo "Localidade não encontrada: " . $distrito->codigo . ';' . $concelho->codigo . ';' . $data[2] . '-' . $data[3] . "\n";
                    exit(1);
                }

                $logradouro = '';
                $logradouro .= ( ! empty( $data[5] ) ? $data[5] . ' ' : '' );
                $logradouro .= ( ! empty( $data[6] ) ? $data[6] . ' ' : '' );
                $logradouro .= ( ! empty( $data[7] ) ? $data[7] . ' ' : '' );
                $logradouro .= ( ! empty( $data[8] ) ? $data[8] . ' ' : '' );
                $logradouro .= ( ! empty( $data[9] ) ? $data[9] . ' ' : '' );
                $logradouro = trim( $logradouro );

                $codigo_postal_data = [
                    'distrito_id'       => $distrito->id,
                    'concelho_id'       => $concelho->id,
                    'localidade_id'     => $localidade->id,
                    'codigo_distrito'   => $last_distrito,
                    'codigo_concelho'   => $last_concelho,
                    'codigo_localidade' => $last_localidade,
                    'logradouro'        => $logradouro,
                    'local'             => $data[10],
                    'troco'             => $data[11],
                    'porta'             => $data[12],
                    'cliente'           => $data[13],
                    'cpost_4'           => $data[14],
                    'cpost_3'           => $data[15],
                    'descritivo_postal'    => $data[16],
                ];

                CodigoPostal::insertOrIgnore($codigo_postal_data);
                $count++;
            }

            fclose($open);
        }
        echo "Inseridos {$count} códigos postais.\n";
    }
}
