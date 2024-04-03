<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_users')->insert([
            'id' => 1,
            'name' => "Nora",
            'email' => "nora@gmail.com",
            'username' => "nora11",
            'password' => "nora",
            'role' => 1,
        ]);

        DB::table('event_users')->insert([
            'id' => 2,
            'name' => "David",
            'email' => "david@gmail.com",
            'username' => "david10",
            'password' => "david",
            'role' => 1,
        ]);

        DB::table('event_users')->insert([
            'id' => 3,
            'name' => "Ashley",
            'email' => "ashley@gmail.com",
            'username' => "ashley8",
            'password' => "ashley",
            'role' => 1,
        ]);

    }

}
