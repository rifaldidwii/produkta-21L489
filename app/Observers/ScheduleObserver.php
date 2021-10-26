<?php

namespace App\Observers;

use App\Models\Schedule;
use App\Models\User;
use App\Notifications\ScheduleNotification;
use Illuminate\Support\Facades\Notification;

class ScheduleObserver
{
    /**
     * Handle the Schedule "updated" event.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        $users = User::find($schedule->classroom->students()->pluck('user_id'));

        Notification::send($users, new ScheduleNotification($schedule));
    }
}
