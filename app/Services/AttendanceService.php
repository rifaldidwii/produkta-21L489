<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Student;

class AttendanceService
{
    private $schedule;

    private $baseLatitude, $baseLongitude, $requestLatitude, $requestLongitude;

    private $students;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Get attendance status
     *
     * @return string
     */
    public function getAttendanceStatus(float $requestLatitude, float $requestLongitude): string
    {
        $this->requestLatitude = $requestLatitude;
        $this->requestLongitude = $requestLongitude;

        $status = 'Terlambat, Luar Area';

        if (now()->greaterThan($this->schedule->start_time) && now()->lessThan($this->schedule->end_time)) {
            $status = str_replace('Terlambat', 'Tepat Waktu', $status);
        }

        if ($this->calculateDistance() < 500) {
            $status = str_replace('Luar Area', 'Dalam Area', $status);
        }

        return $status;
    }

    /**
     * Calculate distance position
     *
     * @return int
     */
    private function calculateDistance(): int
    {
        $this->baseLatitude = -8.164520231642912;
        $this->baseLongitude = 112.21858851023774;

        $earth_radius = 6371;

        $dLat = deg2rad($this->requestLatitude - $this->baseLatitude);
        $dLon = deg2rad($this->requestLongitude - $this->baseLongitude);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($this->baseLatitude)) *
            cos(deg2rad($this->requestLatitude)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d * 1000;
    }

    /**
     * Fill student attendances data.
     *
     * @return void
     */
    public function fillStudentAttendances(array $students): void
    {
        $this->students = $students;

        $attendance = $this->schedule->attendances()->first();

        $students = $this->schedule->classroom->students()->get();

        $presentStudents = Student::find($this->students);

        $absentStudents = $students->diff($presentStudents);

        Attendance::withoutEvents(function () use ($attendance, $presentStudents, $absentStudents) {
            foreach ($presentStudents as $student) {
                $student->attendances()->create([
                    'schedule_id' => $this->schedule->id,
                    'latitude' => $attendance->latitude,
                    'longitude' => $attendance->longitude,
                    'status' => $attendance->status,
                ]);
            }

            foreach ($absentStudents as $student) {
                $student->attendances()->create([
                    'schedule_id' => $this->schedule->id,
                    'status' => 'Tidak Hadir',
                ]);
            }
        });
    }
}
