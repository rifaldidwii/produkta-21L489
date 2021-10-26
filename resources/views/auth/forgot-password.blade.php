<x-auth-layout>
    <x-auth-card>
        <x-slot name="header">
            <h1 class="mb-3 h3">Lupa Password?</h1>
            <p class="text-gray">Masukkan email kamu di bawah ini
                dan kami akan mengirimkan tautan untuk mengganti password kamu.</p>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text">
                        <strong>Tautan untuk mereset password telah dikirim ke email kamu.</strong>
                    </span>
                </div>
            @endif
        </x-slot>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-auth-input-group name="email" type="email" placeholder="Masukkan email">
                <x-slot name="icon">
                    <i class="bi bi-person-fill"></i>
                </x-slot>
            </x-auth-input-group>

            <div class="mt-3">
                <x-button class="btn-block">Kirim</x-button>
            </div>
        </form>

        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
            <span class="font-weight-normal">Kembali ke halaman
                <a href="{{ route('login') }}" class="font-weight-bold">login</a>
            </span>
        </div>
    </x-auth-card>
</x-auth-layout>
