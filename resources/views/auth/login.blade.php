<x-auth-layout>
    <x-auth-card>
        <x-slot name="header">
            <h1 class="mb-3 h3">Masuk ke Sistem Informasi Bimbingan Belajar</h1>
            <p class="text-gray">Gunakan email atau username dan password untuk mengakses akun.</p>
        </x-slot>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <x-auth-input-group name="email" type="email" placeholder="Masukkan email atau username">
                <x-slot name="icon">
                    <i class="bi bi-envelope-fill"></i>
                </x-slot>
            </x-auth-input-group>

            <x-auth-input-group name="password" type="password" placeholder="Password">
                <x-slot name="icon">
                    <i class="bi bi-lock-fill"></i>
                </x-slot>
            </x-auth-input-group>

            <div class="d-block d-sm-flex justify-content-between align-items-center mt-2">
                <div class="form-group form-check mt-3">
                    <input type="checkbox"
                        class="form-check-input {{ old('remember') ? 'checked' : '' }}"
                        id="customCheckLogin" name="remember">
                    <label class="form-check-label form-check-sign-white" for="customCheckLogin">Ingat saya</label>
                </div>
                <div>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-right">Lupa password?</a>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <x-button class="btn-block">Masuk</x-button>
            </div>
        </form>

        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
            <span class="font-weight-normal">Belum terdaftar?
                <a href="{{ route('register') }}" class="font-weight-bold">Buat akun</a>
            </span>
        </div>
    </x-auth-card>
</x-auth-layout>
