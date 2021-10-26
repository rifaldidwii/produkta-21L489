<?php

namespace App\Observers;

use App\Models\Attendance;
use App\Models\User;
use App\Notifications\AttendanceNotification;
use Illuminate\Support\Facades\Notification;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return void
     */
    public function created(Attendance $attendance)
    {
        $users = User::find($attendance->schedule->classroom->students()->pluck('user_id'));

        Notification::send($users, new AttendanceNotification($attendance));
    }
}
