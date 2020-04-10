<?php

use App\Aluno;
use App\Nucleo;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlunosSeeder extends Seeder
{

    public function run() {
        $role = 'aluno';

        $data = [
            'Aluno A' => [
                'name' => 'Aluno A',
                'email' => 'alunoa@biko.edu',
                'password' => 'alunoa@biko.edu',
                'phone' => '6430000000',
                'nucleo' => 'Núcleo A',
                'status' => 1,
                'listaEspera' => 'Não',
                'emailVerified' => Carbon::now(),
            ],
            'Aluno B' => [
                'name' => 'Aluno B',
                'email' => 'alunob@biko.edu',
                'password' => 'alunob@biko.edu',
                'phone' => '6440000000',
                'nucleo' => 'Núcleo B',
                'status' => 0,
                'listaEspera' => 'Sim',
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

            Aluno::create([
                'NomeAluno' => $user->name,
                'id_user' => $user->id,
                'Status' => $row['status'],
                'FoneCelular' => $user->phone,
                'Email' => $user->email,
                'id_nucleo' => $nucleo->id,
                'NomeNucleo' => $nucleo->NomeNucleo,
                'ListaEspera' => $row['listaEspera'],
            ]);
        }
    }
}
