<?php

namespace App\Actions\Fortify;

use App\Models\Student;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $rule = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'birthplace' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date_format:Y-m-d'],
        ];

        if ($user->isTeacher()) {
            Validator::make($input, $rule + [
                'field' => ['required', 'string', 'max:255']
            ])->validateWithBag('updateProfileInformation');
        }

        if ($user->isStudent()) {
            Validator::make($input, $rule + [
                'grade' => ['required', 'string', Rule::in(Student::GRADE)],
                'school' => ['required', 'string', 'max:255'],
                'parent_name' => ['required', 'string', 'max:255'],
                'parent_job' => ['required', 'string', 'max:255'],
                'parent_phone' => ['required', 'string', 'max:255'],
            ])->validateWithBag('updateProfileInformation');
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'username' => $input['username'],
                'email' => $input['email'],
            ])->save();
        }

        if (isset($input['profile_photo'])) {
            $user->updateProfilePhoto($input['profile_photo']);
        }

        if ($user->isTeacher()) {
            $user->teacher->forceFill([
                'name' => $input['name'],
                'birthplace' => $input['birthplace'],
                'birthdate' => $input['birthdate'],
                'name' => $input['name'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'field' => $input['field'],
            ])->save();
        }

        if ($user->isStudent()) {
            $user->student->forceFill([
                'name' => $input['name'],
                'birthplace' => $input['birthplace'],
                'birthdate' => $input['birthdate'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'grade' => $input['grade'],
                'school' => $input['school'],
                'parent_name' => $input['parent_name'],
                'parent_job' => $input['parent_job'],
                'parent_phone' => $input['parent_phone'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
