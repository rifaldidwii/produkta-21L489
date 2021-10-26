<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->route('student.home');
    }
}
