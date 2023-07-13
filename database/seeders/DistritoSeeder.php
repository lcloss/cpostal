<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Distrito;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($open = fopen(storage_path() . "/csv/distritos.txt", "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                $distrito_data = [
                    'codigo'    => $data[0],
                    'nome'      => $data[1],
                ];

                Distrito::insertOrIgnore($distrito_data);
            }

            fclose($open);
        }
        
    }
}
