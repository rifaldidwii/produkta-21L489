<?php

namespace App\Notifications;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ScheduleNotification extends Notification
{
    use Queueable;

    /**
     * The schedule instance.
     *
     * @var \App\Models\Schedule
     */
    protected Schedule $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "sender" => $this->schedule->classroom->subject->teacher->name,
            "image" => $this->schedule->classroom->subject->teacher->user->profile_photo,
            "message" => "Jadwal untuk {$this->schedule->classroom->name} dengan mapel {$this->schedule->classroom->subject->name} telah diubah ke hari {$this->schedule->formatted_start_time}"
        ];
    }
}
