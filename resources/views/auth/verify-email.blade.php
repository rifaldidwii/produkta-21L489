<x-auth-layout>
    <x-auth-card>
        <x-slot name="header">
            <h1 class="mb-3 h3">Verifikasi email kamu</h1>
            <p class="text-gray">Sebelum melanjutkan, silahkan periksa email kamu untuk tautan verifikasi.</p>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text">
                        <strong>Tautan untuk verifikasi email telah dikirim ke email kamu.</strong>
                    </span>
                </div>
            @endif
        </x-slot>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-button class="btn-block">Kirim email verifikasi lagi</x-button>
        </form>

        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
            <span class="font-weight-normal">Belum terdaftar?
                <a href="{{ route('register') }}" class="font-weight-bold">Buat akun</a>
            </span>
        </div>
    </x-auth-card>
</x-auth-layout>
