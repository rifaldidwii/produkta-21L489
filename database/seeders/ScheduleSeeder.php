<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            $time = ['14:00:00', '14:30:00', '15:00:00', '15:30:00', '16:00:00', '16:30:00', '17:00:00', '17:30:00'];
            $hex = ['#11cdef', '#fb6340', '#f5365c', '#2dce89', '#172b4d', '#0a48b3'];
            $randStartTime = rand(0, 3);
            $randEndTime = rand(4, 7);
            $randDay = rand(1, 7);
            $randColor = rand(0, 5);
            $startTime = Carbon::parse("2021-02-$randDay $time[$randStartTime]");
            $endTime = Carbon::parse("2021-02-$randDay $time[$randEndTime]");

            DB::table('schedules')->insert([
                'classroom_id' => $classroom->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'color' => $hex[$randColor],
                'recurrence_times' => 21,
                'recurrence_interval' => 7,
                'created_at' => now(),
            ]);

            $scheduleId = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < 20; $i++) {
                $startTime->addWeek();
                $endTime->addWeek();

                DB::table('schedules')->insert([
                    'classroom_id' => $classroom->id,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'color' => $hex[$randColor],
                    'schedule_id' => $scheduleId,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
