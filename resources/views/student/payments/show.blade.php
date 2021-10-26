<x-app-layout>
    @push('styles')
        <style>
            .list-group.simple-list .list-group-item {
                background: 0 0;
                border: none;
                padding: .375rem .125rem;
            }
        </style>
    @endpush

    <div class="container-fluid mt-4">
        <div class="card mb-4">
            <div class="card-header d-print-none">
                <h3 class="mb-0">Kwitansi
                    <a class="btn btn-sm btn-primary float-right" href="#" onclick="window.print()">cetak</a>
                </h3>
            </div>

            <!-- Card body -->
            <div class="card-body p-0">
                <div class="card p-4 p-md-5 position-relative">
                    <div class="d-flex justify-content-between pb-4 pb-md-5 mb-4 mb-md-5 border-bottom border-light">
                        <img src="https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1622704689/rsz_logo_vlgqiv_pfo0vk.png" height="100" alt="Impact Logo">
                        <div>
                            <h4>LKP Ar Risalah</h4>
                            <ul class="list-group simple-list">
                                <li class="list-group-item font-weight-normal">Jl. Mawar 10</li>
                                <li class="list-group-item font-weight-normal">Sutojayan, Blitar</li>
                                <li class="list-group-item font-weight-normal">
                                    <a class="font-weight-bold text-primary" href="#">
                                        <span>lkparrisalah@gmail.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-6 d-flex align-items-center justify-content-center">
                        <h2 class="h1 mb-0">Kwitansi Pembayaran</h2>
                        <span class="badge badge-xl badge-success ml-2">{{ $payment->status }}</span>
                    </div>
                    <div class="row justify-content-between mb-4 mb-md-5">
                        <div class="col-sm">
                            <h5>Informasi Siswa:</h5>
                            <div>
                                <ul class="list-group simple-list">
                                    <li class="list-group-item font-weight-normal">
                                        {{ $payment->student->name }}
                                    </li>
                                    <li class="list-group-item font-weight-normal">
                                        {{ $payment->student->grade . ', ' . $payment->student->school  }}
                                    </li>
                                    <li class="list-group-item font-weight-normal">
                                        {{ $payment->student->address  }}
                                    </li>
                                    <li class="list-group-item font-weight-normal">
                                        <a class="font-weight-bold text-primary" href="#">
                                            <span>{{ $payment->student->user->email  }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm col-lg-4">
                            <div class="row float-right mr-2">
                                {!! $qrcode !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="bg-light border-top">
                                        <tr>
                                            <th scope="row" class="border-0 text-left">No</th>
                                            <th scope="row" class="border-0">Deskripsi</th>
                                            <th scope="row" class="border-0">Tanggal</th>
                                            <th scope="row" class="border-0">Metode</th>
                                            <th scope="row" class="border-0">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-left font-weight-bold h6">1</th>
                                            <td>{{ $payment->description }}</td>
                                            <td>{{ $payment->receipt->formatted_updated_at }}</td>
                                            <td>{{ $payment->receipt->payment_method }}</td>
                                            <td>{{ $payment->formatted_amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end text-right mb-4 py-4 border-bottom">
                                <div class="mt-4">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="right">
                                                    <strong>Rp. {{ number_format($payment->amount) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
