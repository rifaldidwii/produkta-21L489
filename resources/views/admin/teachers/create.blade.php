<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Guru"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Guru
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data">
                @csrf

                <x-app-input-group name="name" type="text" label="Nama"/>

                <x-app-input-group name="username" type="text" label="Nama Panggilan"/>

                <x-app-input-group name="email" type="email" label="Email"/>

                <x-app-input-group name="password" type="password" label="Password (Opsional, Default: sehatmulia)"/>

                <x-app-input-group name="profile_photo" type="file" label="Foto (Opsional)"/>

                <x-app-input-group name="birthplace" type="text" label="Tempat Lahir"/>

                <x-app-input-group name="birthdate" type="datepicker" label="Tanggal Lahir"/>

                <x-app-input-group name="phone" type="text" label="Telepon"/>

                <x-app-input-group name="address" type="text" label="Alamat"/>

                <x-app-input-group name="field" type="text" label="Bidang"/>

                <div class="row">
                    <div class="col">
                        <x-button>Tambah</x-button>
                        <x-link class="btn-danger" :href="route('admin.teachers.index')">Batal</x-link>
                    </div>

                </div>
            </form>
        </div>
    </x-app-card>

    <x-datepicker/>
</x-app-layout>
