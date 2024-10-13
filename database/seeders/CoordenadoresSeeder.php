<?php

namespace Database\Seeders;

use App\Nucleo;
use App\Coordenadores;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoordenadoresSeeder extends Seeder
{

    public function run() {
        $role = 'coordenador';

        $data = [
            'Coordenador A' => [
                'name' => 'Coordenador A',
                'email' => 'coordenadora@biko.edu',
                'password' => 'coordenadora@biko.edu',
                'phone' => '6430000000',
                'nucleo' => 'Núcleo A',
                'status' => 1,
                'emailVerified' => Carbon::now(),
            ],
            'Coordenador B' => [
                'name' => 'Coordenador B',
                'email' => 'coordenadorb@biko.edu',
                'password' => 'coordenadorb@biko.edu',
                'phone' => '6440000000',
                'nucleo' => 'Núcleo B',
                'status' => 0,
                'emailVerified' => null,
            ],
        ];

        foreach ($data as $row) {
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'role' => $role,
                'phone' => $row['phone'],
                'email_verified_at' => $row['emailVerified'],
            ]);

            $nucleo = Nucleo::where('NomeNucleo', $row['nucleo'])->first();

            Coordenadores::create([
                'NomeCoordenador' => $user->name,
                'id_user' => $user->id,
                'Status' => $row['status'],
                'FoneCelular' => $user->phone,
                'Email' => $user->email,
                'id_nucleo' => $nucleo->id,
            ]);
        }
    }
}
