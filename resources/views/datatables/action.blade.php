@isset($classroom)
    <x-link class="btn-sm btn-default" :href="route('admin.classrooms.schedules.index', $classroom)">jadwal</x-link>
    <x-link class="btn-sm btn-info" :href="route('admin.classrooms.show', $classroom)">detail</x-link>
    <x-link class="btn-sm btn-warning" :href="route('admin.classrooms.edit', $classroom)">ubah</x-link>
    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $classroom->id }}">hapus</x-link>

    <x-modal-delete :id="$classroom->id" :name="$classroom->name" :action="route('admin.classrooms.destroy', $classroom)"/>
@endisset

@isset($payment)
    <x-link class="btn-sm btn-info" :href="route('admin.payments.show', $payment)">detail</x-link>
    <x-link class="btn-sm btn-warning" :href="route('admin.payments.edit', $payment)">ubah</x-link>
    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $payment->id }}">hapus</x-link>

    <x-modal-delete :id="$payment->id" :name="$payment->name" :action="route('admin.payments.destroy', $payment)"/>
@endisset

@isset($schedule)
    <x-link class="btn-sm btn-info" :href="route('admin.schedules.show', $schedule)">detail</x-link>
    <x-link class="btn-sm btn-warning" :href="route('admin.schedules.edit', $schedule)">ubah</x-link>
    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $schedule->id}} ">hapus</x-link>

    <x-modal-delete :id="$schedule->id" :name="$schedule->formatted_start_time" :action="route('admin.schedules.destroy', $schedule)"/>
@endisset

@isset($semester)
    @if ($semester->is_active)
        <span class="badge badge-success">Aktif</span>
    @else
        <x-link class="btn-sm btn-info" href="#" data-toggle="modal" data-target="#modal-update-semester-{{ $semester->id}}">ganti</x-link>
        <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $semester->id}} ">hapus</x-link>

        <x-modal-update-semester :id="$semester->id" :action="route('admin.semesters.update', $semester)"/>
        <x-modal-delete :id="$semester->id" :name="$semester->name" :action="route('admin.semesters.destroy', $semester)"/>
    @endif
@endisset

@isset($student)
    <x-link class="btn-sm btn-default" :href="route('admin.students.attendances.index', $student)">presensi</x-link>
    <x-link class="btn-sm btn-info" :href="route('admin.students.show', $student)">detail</x-link>
    <x-link class="btn-sm btn-warning" :href="route('admin.students.edit', $student)">ubah</x-link>
    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $student->id}} ">hapus</x-link>

    <x-modal-delete :id="$student->id" :name="$student->name" :action="route('admin.students.destroy', $student)"/>
@endisset

@isset($subject)
    <x-link class="btn-sm btn-info" :href="route('admin.subjects.show', $subject)">detail</x-link>
    <x-link class="btn-sm btn-warning" :href="route('admin.subjects.edit', $subject)">ubah</x-link>
    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $subject->id}} ">hapus</x-link>

    <x-modal-delete :id="$subject->id" :name="$subject->name" :action="route('admin.subjects.destroy', $subject)"/>
@endisset

@isset($teacher)
    <x-link class="btn-sm btn-default" :href="route('admin.teachers.attendances.index', $teacher)">presensi</x-link>
    <x-link class="btn-sm btn-info" :href="route('admin.teachers.show', $teacher)">detail</x-link>
    <x-link class="btn-sm btn-warning" :href="route('admin.teachers.edit', $teacher)">ubah</x-link>
    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $teacher->id }}">hapus</x-link>

    <x-modal-delete :id="$teacher->id" :name="$teacher->name" :action="route('admin.teachers.destroy', $teacher)"/>
@endisset
