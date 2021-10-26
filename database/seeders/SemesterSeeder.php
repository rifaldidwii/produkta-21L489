<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([
            'name' => 'Ganjil',
            'academic_year' => '2020/2021',
            'is_active' => 0,
            'created_at' => now()
        ]);
        DB::table('semesters')->insert([
            'name' => 'Genap',
            'academic_year' => '2020/2021',
            'is_active' => 1,
            'created_at' => now()
        ]);
        DB::table('semesters')->insert([
            'name' => 'Ganjil',
            'academic_year' => '2021/2022',
            'is_active' => 0,
            'created_at' => now()
        ]);
    }
}
