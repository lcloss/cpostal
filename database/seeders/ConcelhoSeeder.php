<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Distrito;
use App\Models\Concelho;

class ConcelhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($open = fopen(storage_path() . "/csv/concelhos.txt", "r")) !== FALSE) {

            $last_distrito = '';

            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                if ( $last_distrito != $data[0] ) {
                    $last_distrito = $data[0];
                    $distrito = Distrito::where('codigo', $last_distrito)->first();
                }

                $concelho_data = [
                    'distrito_id'       => $distrito->id,
                    'codigo_distrito'   => $data[0],
                    'codigo'            => $data[1],
                    'nome'              => $data[2],
                ];

                Concelho::insertOrIgnore($concelho_data);
            }

            fclose($open);
        }
    }
}
