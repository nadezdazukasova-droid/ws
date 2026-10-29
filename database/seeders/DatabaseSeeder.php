<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Администратор
        User::create([
            'name' => 'Admin',
            'email' => 'admin@whitesmile.ru',
            'phone' => '+7 (999) 000-00-00',
            'role' => 'admin',
            'password' => Hash::make('admin12345'),
        ]);

        // Наполнение базы
        $this->call([
            ServiceSeeder::class,
            DoctorSeeder::class,
            PortfolioSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}