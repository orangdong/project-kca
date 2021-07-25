<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'toko_id' => 1,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('zilonglayla515'),
            'role' => 'admin'
        ];

        User::create($data);
    }
}
