<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
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
            $teacher = Teacher::with('user')->select('teachers.*')->latest();

            return DataTables::of($teacher)
                ->addIndexColumn()
                ->addColumn('action', function ($teacher) {
                    return view('datatables.action', compact('teacher'));
                })
                ->toJson();
        }

        return view('admin.teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTeacherRequest $request)
    {
        $user = User::create(['role_id' => 2] + $request->validated());

        $user->markEmailAsVerified();

        if (!$request->password) {
            $user->updatePassword('sehatmulia');
        }

        if ($request->profile_photo) {
            $user->updateProfilePhoto($request->profile_photo);
        }

        Teacher::create(['user_id' => $user->id] + $request->validated());

        return redirect()->route('admin.teachers.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\View\View
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('classrooms.subject', 'user');

        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\View\View
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('user');

        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->user->update($request->validated());

        if ($request->profile_photo) {
            $teacher->user->updateProfilePhoto($request->profile_photo);
        }

        $teacher->update($request->validated());

        return redirect()->route('admin.teachers.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Teacher $teacher)
    {
        if ($teacher->classrooms()->exists()) {
            return redirect()->route('admin.teachers.index')->with('danger', 'Data gagal dihapus, guru masih memiliki kelas');
        }

        $teacher->delete();

        $teacher->user()->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Data berhasil dihapus, <a class="text-white" href="' . route('admin.teachers.restore', $teacher->id) . '">Kembalikan</a>');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $teacher_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $teacher_id)
    {
        $teacher = Teacher::onlyTrashed()->findOrFail($teacher_id);

        $teacher->restore();

        $user = User::onlyTrashed()->find($teacher->user_id);

        $user->restore();

        return redirect()->route('admin.teachers.index')->with('success', 'Data berhasil dikembalikan');
    }
}
