<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-student', function (User $user, Classroom $classroom, Student $student) {
            return $user->isTeacher() && $classroom->students->contains($student);
        });

        Gate::define('view-classroom', function (User $user, Classroom $classroom) {
            if ($user->isTeacher()) {
                return $user->teacher->classrooms->contains($classroom);
            }

            if ($user->isStudent()) {
                return $user->student->classrooms->contains($classroom) || $user->student->grade == $classroom->subject->grade;
            }
        });

        Gate::define('update-classroom', function (User $user, Classroom $classroom) {
            return $user->isStudent() && !$user->student->classrooms->contains($classroom) && $user->student->grade == $classroom->subject->grade;
        });

        Gate::define('view-payment', function (User $user, Payment $payment) {
            return $user->isStudent() && $user->student == $payment->student && $payment->status == 'Lunas' && $payment->receipt;
        });

        Gate::define('update-payment', function (User $user, Payment $payment) {
            return $user->isStudent() && $user->student == $payment->student && $payment->status != 'Lunas' && !$payment->receipt;
        });

        Gate::define('update-schedule', function (User $user, Schedule $schedule) {
            return $user->isTeacher() && now()->lessThan($schedule->start_time) && $schedule->classroom->subject->teacher == $user->teacher;
        });

        Gate::define('create-attendance', function (User $user, Schedule $schedule) {
            return $user->isTeacher() && now()->greaterThan($schedule->start_time) && $schedule->attendances_count < 1 && $schedule->classroom->subject->teacher == $user->teacher;
        });
    }
}
