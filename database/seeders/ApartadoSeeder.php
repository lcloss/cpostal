<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartado;

class ApartadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($open = fopen(storage_path() . "/csv/todos_aps.txt", "r")) !== FALSE) {

            $count = 0;
            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                $name = $data[0];
                $first_space = strpos($name, ' ');
                $tipo = substr($name, 0, $first_space);
                $designacao = substr($name, $first_space + 1);

                if ( !empty( $data[3] ) && !empty( $data[4] ) ) {
                    $is_block = TRUE;
                    $cp4 = $data[3];
                    $cp3 = $data[4];
                    $local = $data[5];
                } else {
                    $is_block = FALSE;
                    $cp4 = $data[6];
                    $cp3 = $data[7];
                    $local = $data[8];
                }

                $apartado_data = [
                    'tipo'              => $tipo,
                    'denominacao'       => $designacao,
                    'apa_inicio'        => $data[1],
                    'apa_final'         => $data[2],
                    'e_bloco'           => $is_block,
                    'cpost_4'           => $cp4,
                    'cpost_3'           => $cp3,
                    'descritivo_postal' => $local,
                ];

                Apartado::insertOrIgnore($apartado_data);
                $count++;
            }

            fclose($open);
        }

        echo "Inseridos {$count} apartados.\n";
    }
}
