<?php

use App\Nucleo;
use App\Professores;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfessoresSeeder extends Seeder
{

    public function run() {
        $role = 'professor';

        $data = [
            'Professor A' => [
                'name' => 'Professor A',
                'email' => 'Professora@biko.edu',
                'password' => 'Professora@biko.edu',
                'phone' => '6430000000',
                'nucleo' => 'Núcleo A',
                'status' => 1,
                'emailVerified' => Carbon::now(),
            ],
            'Professor B' => [
                'name' => 'Professor B',
                'email' => 'Professorb@biko.edu',
                'password' => 'Professorb@biko.edu',
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

            Professores::create([
                'NomeProfessor' => $user->name,
                'id_user' => $user->id,
                'Status' => $row['status'],
                'FoneCelular' => $user->phone,
                'Email' => $user->email,
                'id_nucleo' => $nucleo->id,
            ]);
        }
    }
}
