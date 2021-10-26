<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Guru"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Ubah Data Guru
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-app-input-group name="name" type="text" label="Nama" value="{{ $teacher->name }}"/>

                <x-app-input-group name="username" type="text" label="Nama Panggilan" value="{{ $teacher->user->username }}"/>

                <x-app-input-group name="email" type="email" label="Email" value="{{ $teacher->user->email }}"/>

                <x-app-input-group name="password" type="password" label="Password (Opsional)"/>

                <div class="row">
                    <div class="col-md-12">
                        <img id="preview" src="{{ $teacher->user->profile_photo }}"
                            class="rounded-circle img-left img-fluid shadow shadow-lg--hover mb-4"
                            style="width: 140px;">
                    </div>
                </div>

                <x-app-input-group name="profile_photo" type="file" label="Foto (Opsional)"/>

                <x-app-input-group name="birthplace" type="text" label="Tempat Lahir" value="{{ $teacher->birthplace }}"/>

                <x-app-input-group name="birthdate" type="datepicker" label="Tanggal Lahir" value="{{ $teacher->birthdate }}"/>

                <x-app-input-group name="phone" type="text" label="Telepon" value="{{ $teacher->phone }}"/>

                <x-app-input-group name="address" type="text" label="Alamat" value="{{ $teacher->address }}"/>

                <x-app-input-group name="field" type="text" label="Jurusan" value="{{ $teacher->field }}"/>

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
                        <x-link class="btn-danger" :href="route('admin.teachers.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-datepicker/>
</x-app-layout>
