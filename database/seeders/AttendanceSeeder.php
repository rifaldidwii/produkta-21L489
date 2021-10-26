<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = Schedule::with(['classroom.subject.teacher', 'classroom.students'])->where('start_time', '<=', now())->get();

        foreach ($schedules as $schedule) {
            $teacher = $schedule->classroom->subject->teacher;
            $students = $schedule->classroom->students;

            $latitude = [-8.164759, -8.164552, -8.165120, -8.164326, -8.165292, -8.165295, -8.165353];
            $longitude = [112.219310, 112.217714, 112.217665, 112.218589, 112.218661, 112.218031, 112.219976];

            $rand = rand(0, 6);

            $time = Carbon::parse($schedule->start_time)->addMinutes(rand(1, 20));

            DB::table('attendances')->insert([
                'schedule_id' => $schedule->id,
                'attendanceable_id' => $teacher->id,
                'attendanceable_type' => 'App\Models\Teacher',
                'latitude' => $latitude[$rand],
                'longitude' => $longitude[$rand],
                'status' => 'Tepat Waktu, Dalam Area',
                'created_at' => $time
            ]);

            $statuses = ['Tepat Waktu, Dalam Area', 'Tidak Hadir'];

            foreach ($students as $student) {
                $status = $statuses[rand(0, 1)];

                DB::table('attendances')->insert([
                    'schedule_id' => $schedule->id,
                    'attendanceable_id' => $student->id,
                    'attendanceable_type' => 'App\Models\Student',
                    'latitude' => $status != 'Tidak Hadir' ? $latitude[$rand] : null,
                    'longitude' => $status != 'Tidak Hadir' ? $longitude[$rand] : null,
                    'status' => $status,
                    'created_at' => $time
                ]);
            }
        }
    }
}
