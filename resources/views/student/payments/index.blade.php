<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Pembayaran"/>

    <!-- Page content -->
    <x-app-card class="py-0">
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Pembayaran
        </x-slot>

        <x-alert type="warning"/>

        <!-- Card body -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <b>{{ $payment->formatted_amount }}</b>
                            </td>
                            <td>{{ $payment->description }}</td>
                            @if ($payment->status == 'Lunas')
                                <td>
                                    <span class="badge badge-info">{{ $payment->status }}</span>
                                </td>
                                @if ($payment->receipt()->exists())
                                    <td>
                                        <x-link class="btn-sm btn-info" :href="route('student.payments.show', $payment)">detail</x-link>
                                    </td>
                                @endif
                            @elseif (($payment->status == 'Belum Dibayar'))
                                <td>
                                    <span class="badge badge-danger">{{ $payment->status }}</span>
                                </td>
                                <td>
                                    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-select-payment-method-{{ $payment->id }}">pilih</x-link>
                                </td>

                                <x-modal-select-payment-method :id="$payment->id" :action="route('student.payments.update', $payment)"/>
                            @elseif (($payment->status == 'Diproses'))
                                <td>
                                    <span class="badge badge-warning">{{ $payment->status }}</span>
                                </td>
                                <td>
                                    <x-link class="btn-sm btn-warning" :href="$payment->receipt->checkout_url" target="_blank">bayar</x-link>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-app-card>
</x-app-layout>
