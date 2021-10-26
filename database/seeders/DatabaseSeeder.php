<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InformationSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            SubjectSeeder::class,
            SemesterSeeder::class,
            ClassroomSeeder::class,
            ClassroomStudentSeeder::class,
            ScheduleSeeder::class,
            AttendanceSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
