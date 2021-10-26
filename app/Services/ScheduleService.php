<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleService
{
    private $schedule;

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
     * Create recurring schedule
     *
     * @return void
     */
    public function createRecurringSchedule(): void
    {
        $startTime = Carbon::parse($this->schedule->start_time);
        $endTime = Carbon::parse($this->schedule->end_time);

        for ($i = 0; $i < $this->schedule->recurrence_times - 1; $i++) {
            $startTime->addDays($this->schedule->recurrence_interval);
            $endTime->addDays($this->schedule->recurrence_interval);

            $this->schedule->schedules()->create([
                'classroom_id' => $this->schedule->classroom_id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'color' => $this->schedule->color
            ]);
        }
    }

    /**
     * Update recurring schedule
     *
     * @return void
     */
    public function updateRecurringSchedule(): void
    {
        $startTime = Carbon::parse($this->schedule->start_time);
        $endTime = Carbon::parse($this->schedule->end_time);

        $recurrence_interval = '7';

        $schedules = [];

        if ($this->schedule->schedules()->exists()) {
            $schedules = $this->schedule->schedules()->get();

            $recurrence_interval = $this->schedule->recurrence_interval;
        } else if ($this->schedule->schedule()->exists()) {
            $schedules = $this->schedule->schedule->schedules()->get()->where('id', '>', $this->schedule->id);

            $recurrence_interval = $this->schedule->schedule->recurrence_interval;
        }

        foreach ($schedules as $schedule) {
            $startTime->addDays($recurrence_interval);
            $endTime->addDays($recurrence_interval);

            $schedule->update([
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);
        }
    }
}
