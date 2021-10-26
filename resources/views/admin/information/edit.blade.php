<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Informasi"/>

    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Ubah Data Informasi
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.information.update', $information) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($information->name == 'Foto')
                    <div class="row">
                        <div class="col-md-12">
                            <img id="preview" class="card-img-top rounded-top img-left img-fluid shadow shadow-lg--hover mb-4" style="width: 350px" src="{{ $information->description }}" alt="">
                        </div>
                    </div>

                    <x-app-input-group name="photo" type="file" label="Foto LKP Ar Risalah"/>
                @else
                    <x-app-input-group name="description" type="textarea" label="{{ $information->name }} LKP Ar Risalah" value="{{ $information->description }}"/>
                @endif

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
                        <x-link class="btn-danger" :href="route('admin.information.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>
</x-app-layout>
