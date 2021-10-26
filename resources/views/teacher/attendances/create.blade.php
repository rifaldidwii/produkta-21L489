<x-app-layout>
    <x-leaflet/>

    <!-- Title -->
    <x-title text="Menu Presensi Guru"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Presensi
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('teacher.schedules.attendances.store', $schedule) }}">
                @csrf

                <input type="hidden" id="latitude" name="latitude" value="">

                <input type="hidden" id="longitude" name="longitude" value="">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="location">Lokasi Saat Ini (Pastikan lokasi presensi berada dalam area lingkaran)</label>
                            <div id="mapid" class="mt-2"></div>
                            <script>
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition((position) => {
                                        document.getElementById('latitude').value = position.coords.latitude;
                                        document.getElementById('longitude').value = position.coords.longitude;

                                        let baseLatitude = -8.164520231642912;
                                        let baseLongitude = 112.21858851023774;

                                        const mymap = L.map('mapid').setView([baseLatitude, baseLongitude], 16);
                                        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                            maxZoom: 18,
                                            id: 'mapbox/streets-v11',
                                            tileSize: 512,
                                            zoomOffset: -1,
                                            accessToken: 'pk.eyJ1IjoiZHdpLXJpZmFsZGk0MTI5OSIsImEiOiJja2JsdDRnd2MxYzh4Mnhsc25ndXZwcjQyIn0.vYl2V9F_D-qdVwc0IMg6zA'
                                        }).addTo(mymap);

                                        L.circle([baseLatitude, baseLongitude], 500).addTo(mymap);

                                        L.marker([position.coords.latitude, position.coords.longitude]).addTo(mymap).bindPopup("<b>Lokasi saat ini</b>").openPopup();
                                    });
                                }
                            </script>
                        </div>
                    </div>
                </div>

                <x-app-input-group name="students" type="checkbox" label="Siswa">
                    <x-slot name="option">
                        @foreach ($students as $student)
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="students-{{ $student->id }}" name="students[]" type="checkbox" value="{{ $student->id }}">
                                <label class="custom-control-label" for="students-{{ $student->id }}">{{ $student->name }}</label>
                            </div>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <div class="row">
                    <div class="col">
                        <x-button>Simpan</x-button>
                        <x-link class="btn-danger" :href="route('teacher.schedules.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>
</x-app-layout>
