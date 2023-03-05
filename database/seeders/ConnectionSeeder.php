<?php

namespace Database\Seeders;

use App\Constants\RequestType;
use App\Models\Connection;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConnectionSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 0; $i < 1000; $i++) {
            Connection::query()
                ->create([
                    'user_from' => random_int(1,500),
                    'user_to' => random_int(1,500),
                    'status' => RequestType::COMPLETED
                ]);
        }
    }
}
