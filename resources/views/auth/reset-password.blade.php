<x-auth-layout>
    <x-auth-card>
        <x-slot name="header">
            <h1 class="h3 font-weight-bold mb-3">Ubah Password</h1>
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-auth-input-group name="email" type="email" placeholder="Masukkan email" value="{{ $request->email }}">
                <x-slot name="icon">
                    <i class="bi bi-person-fill"></i>
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
                <x-button class="btn-block">Simpan</x-button>
            </div>
        </form>
        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
            <span class="font-weight-normal">Kembali ke halaman
                <a href="{{ route('login') }}" class="font-weight-bold">login</a>
            </span>
        </div>
    </x-auth-card>
</x-auth-layout>
