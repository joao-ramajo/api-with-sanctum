<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'appConsumer001',
                'email' => 'app_consumer_001@app.com',
                'password' => bcrypt('Aa123456'),
            ],
            [
                'name' => 'appConsumer002',
                'email' => 'app_consumer_002@app.com',
                'password' => bcrypt('Aa123456'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
