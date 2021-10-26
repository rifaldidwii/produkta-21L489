<?php

namespace App\Notifications;

use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttendanceNotification extends Notification
{
    use Queueable;

    /**
     * The attendance instance.
     *
     * @var \App\Models\Attendance
     */
    protected Attendance $attendance;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
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
            "sender" => $this->attendance->schedule->classroom->subject->teacher->name,
            "image" => $this->attendance->schedule->classroom->subject->teacher->user->profile_photo,
            "message" => "Presensi untuk {$this->attendance->schedule->classroom->name} dengan mapel {$this->attendance->schedule->classroom->subject->name} telah ditambahkan dengan status {$this->attendance->status} pada {$this->attendance->formatted_created_at}"
        ];
    }
}
