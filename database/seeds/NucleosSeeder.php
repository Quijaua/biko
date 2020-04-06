<?php

use App\Nucleo;
use Illuminate\Database\Seeder;

class NucleosSeeder extends Seeder
{

    public function run() {
        $data = [
            'Núcleo A' => [
                'Status' => 1,
                'NomeNucleo' => 'Núcleo A',
            ],
            'Núcleo B' => [
                'Status' => 0,
                'NomeNucleo' => 'Núcleo B',
            ],
        ];

        foreach ($data as $row) {
            Nucleo::create($row);
        }

        return Nucleo::all();
    }
}
