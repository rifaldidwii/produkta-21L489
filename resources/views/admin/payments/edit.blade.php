<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Pembayaran"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Ubah Data Pembayaran
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.payments.update', $payment) }}">
                @csrf
                @method('PUT')

                <x-app-input-group name="student_id" type="select-single" label="Siswa">
                    <x-slot name="option">
                        @foreach($students as $student)
                            @if($student->id == $payment->student_id)
                                <option value="{{ $student->id }}" selected>{{ $student->name }}</option>
                            @endif
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="amount" type="number" label="Jumlah" value="{{ $payment->amount }}"/>

                <x-app-input-group name="description" type="text" label="Deskripsi" value="{{ $payment->description }}"/>

                <x-app-input-group name="status" type="select-single" label="Status">
                    <x-slot name="option">
                        <option value="Belum Dibayar">Belum Dibayar</option>
                        @if($payment->status == 'Lunas')
                            <option value="Lunas" selected>Lunas</option>
                        @endif
                    </x-slot>
                </x-app-input-group>

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
                        <x-link class="btn-danger" :href="route('admin.payments.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-select2>
        <script>
            $(document).ready(function () {
                $('#student_id').select2();
            });
        </script>
    </x-select2>
</x-app-layout>
