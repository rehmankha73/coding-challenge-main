<?php

namespace Database\Seeders;

use App\Constants\RequestType;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for($i = 0; $i < 100; $i++) {
            Request::query()
                ->create([
                'user_from' => 1,
                'user_to' => random_int(1,500),
                'status' => RequestType::REQUEST_TYPES[random_int(0,1)]
            ]);

            Request::query()
                ->create([
                    'user_from' => random_int(1,500),
                    'user_to' => 1,
                    'status' => RequestType::REQUEST_TYPES[random_int(0,1)]
                ]);
        }
    }
}
