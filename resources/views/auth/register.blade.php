<x-auth-layout>
    <x-auth-card>
        <x-slot name="header">
            <h1 class="h3 font-weight-bold mb-3">Registrasi Siswa Baru</h1>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-auth-input-group name="name" type="text" placeholder="Nama lengkap">
                <x-slot name="icon">
                    <i class="bi bi-person-fill"></i>
                </x-slot>
            </x-auth-input-group>

            <x-auth-input-group name="email" type="email" placeholder="Email">
                <x-slot name="icon">
                    <i class="bi bi-envelope-fill"></i>
                </x-slot>
            </x-auth-input-group>

            <x-auth-input-group name="password" type="password" placeholder="Password">
                <x-slot name="icon">
                    <i class="bi bi-lock-fill"></i>
                </x-slot>
            </x-auth-input-group>

            <x-auth-input-group name="password_confirmation" type="password" placeholder="Konfirmasi Password">
                <x-slot name="icon">
                    <i class="bi bi-lock"></i>
                </x-slot>
            </x-auth-input-group>

            <div class="mt-3">
                <x-button class="btn-block">Daftar</x-button>
            </div>
        </form>

        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
            <span class="font-weight-normal">Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-weight-bold">Masuk sekarang</a>
            </span>
        </div>
    </x-auth-card>
</x-auth-layout>
