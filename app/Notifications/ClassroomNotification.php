<?php

namespace App\Notifications;

use App\Models\Classroom;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClassroomNotification extends Notification
{
    use Queueable;

    /**
     * The classroom instance.
     *
     * @var \App\Models\Classroom
     */
    protected Classroom $classroom;

    /**
     * The message data.
     *
     * @var string
     */
    protected string $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Classroom $classroom, string $message)
    {
        $this->classroom = $classroom;
        $this->message = $message;
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
            "sender" => $this->classroom->subject->teacher->name,
            "image" => $this->classroom->subject->teacher->user->profile_photo,
            "message" => "Pesan untuk kelas {$this->classroom->name} mapel {$this->classroom->subject->name} : {$this->message}"
        ];
    }
}
