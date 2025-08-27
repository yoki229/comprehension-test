<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        $user = [
            'name' => '高知鉄久',
            'email' => 'coachtech@mail.com',
            'password' => bcrypt('password'),
        ];

        //データが重複しない為に記述
        DB::table('users')->updateOrInsert(
            ['email' => $user['email']],$user
        );
    }
}

