<?php

namespace Database\Seeders;

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
        $users = [
            ['name' => 'Aleksa', 'email' => 'aleksa@example.com', 'password' => Hash::make('aleksa123')],
            ['name' => 'Tina', 'email' => 'tina@example.com', 'password' => Hash::make('tina123')],
            ['name' => 'Dejan', 'email' => 'dejan@example.com', 'password' => Hash::make('dejan123')]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
        $this->call([

            BrandSeeder::class,
            CarSeeder::class,
            RentalSeeder::class
        ]);
    }
}
