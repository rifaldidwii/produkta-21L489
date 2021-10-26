<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClassroomScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Classroom
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables|\Illuminate\View\View
     */
    public function index(Classroom $classroom, Request $request)
    {
        if ($request->ajax()) {
            $schedule = Schedule::where('classroom_id', $classroom->id);

            return DataTables::of($schedule)
                ->addIndexColumn()
                ->editColumn('start_time', function ($schedule) {
                    return $schedule->formatted_start_time;
                })
                ->editColumn('end_time', function ($schedule) {
                    return $schedule->formatted_end_time;
                })
                ->addColumn('action', function ($schedule) {
                    return view('datatables.action', compact('schedule'));
                })
                ->toJson();
        }

        return view('admin.schedules.index', compact('classroom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Classroom $classroom)
    {
        return view('admin.schedules.create', compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Classroom $classroom, StoreScheduleRequest $request)
    {
        $schedule = $classroom->schedules()->create($request->validated());

        if ($request->recurrence_times && $request->recurrence_interval) {
            (new ScheduleService($schedule))->createRecurringSchedule();
        }

        return redirect()->route('admin.classrooms.schedules.index', $classroom)->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\View\View
     */
    public function show(Schedule $schedule)
    {
        $schedule->load('classroom.students', 'classroom.subject.teacher')->loadCount('attendances');

        $schedule->attendances->load('attendanceable');

        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\View\View
     */
    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
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
        $schedule->update($request->validated());

        if ($request->recurring) {
            (new ScheduleService($schedule))->updateRecurringSchedule();
        }

        return redirect()->route('admin.classrooms.schedules.index', $schedule->classroom)->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->attendances()->exists()) {
            return redirect()->route('admin.classrooms.schedules.index')->with('danger', 'Data gagal dihapus, jadwal masih memiliki presensi');
        }

        $schedule->delete();

        return redirect()->route('admin.classrooms.schedules.index',  $schedule->classroom)->with('success', 'Data berhasil dihapus');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $schedule_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $schedule_id)
    {
        $schedule = Schedule::onlyTrashed()->findOrFail($schedule_id);

        $schedule->restore();

        return redirect()->route('admin.schedules.index')->with('success', 'Data berhasil dikembalikan');
    }
}
