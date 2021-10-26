<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Resources\ScheduleCollection;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $schedules = new ScheduleCollection(
            Schedule::forClassrooms(auth()->user()->teacher->classrooms()->pluck('classrooms.id'))->get()
        );

        return view('teacher.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\View\View
     */
    public function edit(Schedule $schedule)
    {
        $this->authorize('update-schedule', $schedule);

        return view('teacher.schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $this->authorize('update-schedule', $schedule);

        $schedule->update($request->validated());

        return redirect()->route('teacher.schedules.index', $schedule->classroom)->with('success', 'Data berhasil diubah');
    }
}
