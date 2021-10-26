<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Where to redirect users after login or register.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.home');
        }

        if (auth()->user()->isTeacher()) {
            return redirect()->route('teacher.home');
        }

        if (auth()->user()->isStudent()) {
            return redirect()->route('student.home');
        }
    }
}
