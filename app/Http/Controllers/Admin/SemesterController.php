<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSemesterRequest;
use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SemesterController extends Controller
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
            $semester = Semester::orderBy('is_active', 'desc');

            return DataTables::of($semester)
                ->addIndexColumn()
                ->addColumn('action', function ($semester) {
                    return view('datatables.action', compact('semester'));
                })
                ->toJson();
        }

        return view('admin.semesters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $names = Semester::NAME;

        $years = Semester::YEAR;

        return view('admin.semesters.create', compact('names', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSemesterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSemesterRequest $request)
    {
        Semester::create($request->validated());

        return redirect()->route('admin.semesters.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Semester $semester)
    {
        $oldSemester = Semester::active();

        $oldSemester->update(['is_active' => 0]);

        $semester->update(['is_active' => 1]);

        return redirect()->route('admin.semesters.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Semester $semester)
    {
        if ($semester->classrooms()->exists()) {
            return redirect()->route('admin.semesters.index')->with('danger', 'Data gagal dihapus, semester masih memiliki kelas');
        }

        $semester->delete();

        return redirect()->route('admin.semesters.index')->with('success', 'Data berhasil dihapus, <a class="text-white" href="' . route('admin.semesters.restore', $semester->id) . '">Kembalikan</a>');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $semester_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $semester_id)
    {
        $semester = Semester::onlyTrashed()->findOrFail($semester_id);

        $semester->restore();

        return redirect()->route('admin.semesters.index')->with('success', 'Data berhasil dikembalikan');
    }
}
