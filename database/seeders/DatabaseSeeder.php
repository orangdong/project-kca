<?php

namespace Database\Seeders;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $toko = [
            'name' => 'Toko A',
            'lokasi' => 'Jl. Zilong Autowin',
            'phone' => 12345
        ];
        $user = [
            'toko_id' => 1,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('zilonglayla515'),
            'role' => 'admin'
        ];

        Toko::create($toko);
        User::create($user);
    }
}
