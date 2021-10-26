<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\SubjectService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
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
            $subject = Subject::with('teacher')->select('subjects.*')->latest();

            return DataTables::of($subject)
                ->addIndexColumn()
                ->addColumn('action', function ($subject) {
                    return view('datatables.action', compact('subject'));
                })
                ->toJson();
        }

        return view('admin.subjects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $grades = Subject::GRADE;

        $names = Subject::NAME;

        $teachers = Teacher::all();

        return view('admin.subjects.create', compact('grades', 'names', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSubjectRequest $request)
    {
        $filteredSubjects = (new SubjectService($request->count, $request->teacher_id, $request->name, $request->grade))->sanitizeDuplicateSubjects();

        foreach ($filteredSubjects as $subject) {
            Subject::create($subject);
        }

        return redirect()->route('admin.subjects.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\View\View
     */
    public function show(Subject $subject)
    {
        $subject->load('teacher');

        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\View\View
     */
    public function edit(Subject $subject)
    {
        $grades = Subject::GRADE;

        $names = Subject::NAME;

        $subject->load('teacher');

        $teachers = Teacher::all();

        return view('admin.subjects.edit', compact('grades', 'names', 'subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return redirect()->route('admin.subjects.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject)
    {
        if ($subject->classrooms()->exists()) {
            return redirect()->route('admin.subjects.index')->with('danger', 'Data gagal dihapus, mapel masih memiliki kelas');
        }

        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Data berhasil dihapus, <a class="text-white" href="' . route('admin.subjects.restore', $subject->id) . '">Kembalikan</a>');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $subject_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $subject_id)
    {
        $subject = Subject::onlyTrashed()->findOrFail($subject_id);

        $subject->restore();

        return redirect()->route('admin.subjects.index')->with('success', 'Data berhasil dikembalikan');
    }
}
