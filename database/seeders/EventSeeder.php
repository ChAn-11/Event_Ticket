<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('events')->insert([
            'id' => 1,
            'name' => "Spring Fling Festival",
            'date' => "2024/04/11",
           ]);

          DB::table('events')->insert([
            'id' => 2,
            'name' => "Tech Summit 2024",
            'date' => "2024/05/5",
           ]);

          DB::table('events')->insert([
            'id' => 3,
            'name' => "Global Leadership Conference",
            'date' => "2024/04/19",
           ]);
    }
}
