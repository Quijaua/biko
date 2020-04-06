<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{

    public function run() {
        $role = 'administrador';

        $data = [
            'Administrador' => [
                'name' => 'Administrador',
                'email' => 'admin@biko.edu',
                'password' => 'admin@biko.edu',
                'phone' => '6430000000',
                'emailVerified' => Carbon::now(),
            ],
        ];

        foreach ($data as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'role' => $role,
                'phone' => $row['phone'],
                'email_verified_at' => $row['emailVerified'],
            ]);
        }
    }
}
