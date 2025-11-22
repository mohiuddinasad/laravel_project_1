<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::updateOrCreate(
            ['email' => 'mohiuddinasad46@gmail.com'],  // admin exists? update. If not, create.
            [
                'name' => 'Mohiuddin Asad',
                'password' => Hash::make('62516251'),
            ]
        );
    }
}