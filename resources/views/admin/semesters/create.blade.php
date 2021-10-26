<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Semester"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Semester
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.semesters.store') }}">
                @csrf

                <x-app-input-group name="name" type="select-single" label="Semester">
                    <x-slot name="option">
                        @foreach($names as $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="academic_year" type="select-single" label="Tahun Akademik">
                    <x-slot name="option">
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <div class="row">
                    <div class="col">
                        <x-button>Tambah</x-button>
                        <x-link class="btn-danger" :href="route('admin.semesters.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>
</x-app-layout>
