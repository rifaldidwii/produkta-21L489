<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use App\Services\ClassroomService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
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
            $student = Student::with('user')->select('students.*')->latest();

            return DataTables::of($student)
                ->addIndexColumn()
                ->addColumn('action', function ($student) {
                    return view('datatables.action', compact('student'));
                })
                ->toJson();
        }

        return view('admin.students.index', ['grades' => Student::GRADE]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->grade) {
            return (new ClassroomService($request->grade))->getClassroomOptions();
        }

        $grades = Student::GRADE;

        return view('admin.students.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStudentRequest $request)
    {
        $user = User::create(['role_id' => 3] + $request->validated());

        $user->markEmailAsVerified();

        if (!$request->password) {
            $user->updatePassword('sehatmulia');
        }

        if ($request->profile_photo) {
            $user->updateProfilePhoto($request->profile_photo);
        }

        $student = Student::create(['user_id' => $user->id] + $request->validated());

        $student->classrooms()->attach($request->classrooms);

        return redirect()->route('admin.students.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\View\View
     */
    public function show(Student $student)
    {
        $student->load('classrooms.subject.teacher', 'payments', 'user');

        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\View\View
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::available($student->grade)->get();

        $grades = Student::GRADE;

        $student->load('user');

        return view('admin.students.edit', compact('classrooms', 'grades', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->user->update($request->validated());

        if ($request->profile_photo) {
            $student->user->updateProfilePhoto($request->profile_photo);
        }

        $student->update($request->validated());

        return redirect()->route('admin.students.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student)
    {
        if ($student->classrooms()->exists()) {
            return redirect()->route('admin.students.index')->with('danger', 'Data gagal dihapus, siswa masih memiliki kelas');
        }

        $student->delete();

        $student->user()->delete();

        $student->payments()->delete();

        return redirect()->route('admin.students.index')->with('success', 'Data berhasil dihapus, <a class="text-white" href="' . route('admin.students.restore', $student->id) . '">Kembalikan</a>');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $student_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $student_id)
    {
        $student = Student::onlyTrashed()->findOrFail($student_id);

        $student->restore();

        $user = User::onlyTrashed()->find($student->user_id);

        $user->restore();

        $payments = Payment::onlyTrashed()->where('student_id', $student->id)->get();

        $payments->each(function ($payment) {
            $payment->restore();
        });

        return redirect()->route('admin.students.index')->with('success', 'Data berhasil dikembalikan');
    }
}
