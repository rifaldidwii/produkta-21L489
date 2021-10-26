<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $classroom = Classroom::with('subject.teacher')->select('classrooms.*')->latest();

            return DataTables::of($classroom)
                ->addIndexColumn()
                ->addColumn('action', function ($classroom) {
                    return view('datatables.action', compact('classroom'));
                })
                ->filter(function ($classroom) use ($request) {
                    return $request->semester_id ? $classroom->semester($request->semester_id) : $classroom->active();
                })
                ->toJson();
        }

        $semesters = Semester::all();

        return view('admin.classrooms.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $subjects = Subject::with('teacher')->get();

        return view('admin.classrooms.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClassroomRequest $request)
    {
        $semester = Semester::active();

        Classroom::create(['semester_id' => $semester->id] + $request->validated());

        return redirect()->route('admin.classrooms.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\View\View
     */
    public function show(Classroom $classroom)
    {
        $classroom->load('semester', 'students', 'subject.teacher');

        $students = Student::where('grade', $classroom->subject->grade)->whereNotIn('id', $classroom->students->pluck('id'))->get();

        return view('admin.classrooms.show', compact('classroom', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\View\View
     */
    public function edit(Classroom $classroom)
    {
        $classroom->load('subject');

        $subjects = Subject::with('teacher')->where('grade', $classroom->subject->grade)->get();

        return view('admin.classrooms.edit', compact('classroom', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        return redirect()->route('admin.classrooms.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classroom $classroom)
    {
        if ($classroom->schedules()->exists() || $classroom->students()->exists()) {
            return redirect()->route('admin.classrooms.index')->with('danger', 'Data gagal dihapus, kelas masih memiliki jadwal/siswa');
        }

        $classroom->delete();

        return redirect()->route('admin.classrooms.index')->with('success', 'Data berhasil dihapus, <a class="text-white" href="' . route('admin.classrooms.restore', $classroom->id) . '">Kembalikan</a>');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $classroom_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $classroom_id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($classroom_id);

        $classroom->restore();

        return redirect()->route('admin.classrooms.index')->with('success', 'Data berhasil dikembalikan');
    }
}
