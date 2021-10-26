<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = Teacher::all();

        for ($i = 7; $i <= 9; $i++) {
            DB::table('subjects')->insert([
                'name' => 'Matematika',
                'teacher_id' => $teachers->where('field', 'Matematika')->pluck('id')->random(),
                'grade' => $i . ' SMP',
                'created_at' => now()
            ]);
            DB::table('subjects')->insert([
                'name' => 'B. Inggris',
                'teacher_id' => $teachers->where('field', 'B. Inggris')->pluck('id')->random(),
                'grade' => $i . ' SMP',
                'created_at' => now()
            ]);
            DB::table('subjects')->insert([
                'name' => 'Biologi',
                'teacher_id' => $teachers->where('field', 'Biologi')->pluck('id')->random(),
                'grade' => $i . ' SMP',
                'created_at' => now()
            ]);
            DB::table('subjects')->insert([
                'name' => 'Fisika',
                'teacher_id' => $teachers->where('field', 'Fisika')->pluck('id')->random(),
                'grade' => $i . ' SMP',
                'created_at' => now()
            ]);
        }

        for ($i = 10; $i <= 12; $i++) {
            DB::table('subjects')->insert([
                'name' => 'Matematika',
                'teacher_id' => $teachers->where('field', 'Matematika')->pluck('id')->random(),
                'grade' => $i . ' SMA',
                'created_at' => now()
            ]);
            DB::table('subjects')->insert([
                'name' => 'Fisika',
                'teacher_id' => $teachers->where('field', 'Fisika')->pluck('id')->random(),
                'grade' => $i . ' SMA',
                'created_at' => now()
            ]);
            DB::table('subjects')->insert([
                'name' => 'Kimia',
                'teacher_id' => $teachers->where('field', 'Kimia')->pluck('id')->random(),
                'grade' => $i . ' SMA',
                'created_at' => now()
            ]);
            DB::table('subjects')->insert([
                'name' => 'Biologi',
                'teacher_id' => $teachers->where('field', 'Biologi')->pluck('id')->random(),
                'grade' => $i . ' SMA',
                'created_at' => now()
            ]);
        }
    }
}
