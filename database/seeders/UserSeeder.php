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
    public function run(): void
    {

        User::query()
            ->create([
                'name'     => 'Rehman Ahmed Khan',
                'email'    => 'rehmankha73@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Secret123@'),
                'remember_token' => 'adIR0zmDsO',
            ]);

        User::factory()
            ->count(500)
            ->create();
    }
}
