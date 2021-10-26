<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Mapel"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Detail Data Mapel
            <x-link class="btn-sm btn-primary float-right" :href="route('admin.subjects.edit', $subject)">ubah</x-link>
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4>Nama</h4>
                    <p>{{ $subject->name }}</p>
                    <h4>Jenjang</h4>
                    <p>{{ $subject->grade }}</p>
                    <h4>Guru</h4>
                    <p>{{ $subject->teacher->name }}</p>
                </div>
            </div>
        </div>
    </x-app-card>
</x-app-layout>
