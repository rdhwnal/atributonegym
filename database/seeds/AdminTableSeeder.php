<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nama' => 'Admin',
            'email' => 'admin@atributonegym.com',
            'no_telepon' => '081234567890',
            'jenis_kelamin' => 'Pria',
            'tanggal_lahir' => date('Y-m-d'),
            'alamat' => "Indonesia",
            'password' => Hash::make('12345678'),
        ]);
    }
}
