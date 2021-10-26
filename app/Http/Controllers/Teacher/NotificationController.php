<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use App\Notifications\ClassroomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Classroom $classroom)
    {
        $users = User::find($classroom->students()->pluck('user_id'));

        Notification::send($users, new ClassroomNotification($classroom, $request->message));

        return redirect()->route('teacher.classrooms.index')->with('success', 'Notifikasi berhasil dikirimkan');
    }
}
