<?php

namespace Database\Seeders;

use App\Models\Toko;
use Illuminate\Database\Seeder;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Toko A',
            'lokasi' => 'Jl. Zilong Autowin',
            'phone' => 12345
        ];

        Toko::create($data);
    }
}
