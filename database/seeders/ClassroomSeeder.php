<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::all()->pluck('id');

        $semester = Semester::active();

        $i = 0;
        foreach (range('A', 'X') as $char) {
            DB::table('classrooms')->insert([
                'semester_id' => $semester->id,
                'subject_id' => $subjects[$i],
                'name' => 'Kelas ' . $char,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $i++;
        }
    }
}
