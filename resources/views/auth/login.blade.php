<x-guest-layout>
    <x-slot name="title">Masuk — EduMind</x-slot>

    <!-- Header -->
    <div class="mb-7">
        <h2 class="font-serif text-2xl font-bold mb-1" style="color: var(--text-primary);">
            Selamat Datang Kembali 👋
        </h2>
        <p class="text-sm" style="color: var(--text-secondary);">
            Masuk untuk melanjutkan perjalanan belajarmu
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl text-sm font-medium"
             style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="form-input w-full {{ $errors->has('email') ? 'error' : '' }}"
                   placeholder="nama@email.com">
            @error('email')
                <p class="mt-1 text-xs" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium" style="color: var(--text-primary);">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs hover:underline" style="color: var(--primary-600);">
                        Lupa password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required
                   class="form-input w-full {{ $errors->has('password') ? 'error' : '' }}"
                   placeholder="••••••••">
            @error('password')
                <p class="mt-1 text-xs" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember me -->
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded" style="accent-color: var(--primary-600);">
            <label for="remember_me" class="text-sm" style="color: var(--text-secondary);">Ingat saya</label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary w-full justify-center py-3 text-sm">
            Masuk ke EduMind →
        </button>

        <!-- Divider -->
        <div class="relative flex items-center gap-3">
            <div class="flex-1 h-px" style="background: var(--border-strong);"></div>
            <span class="text-xs" style="color: var(--text-muted);">atau</span>
            <div class="flex-1 h-px" style="background: var(--border-strong);"></div>
        </div>

        <!-- Register link -->
        <p class="text-center text-sm" style="color: var(--text-secondary);">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium hover:underline" style="color: var(--primary-600);">
                Daftar gratis
            </a>
        </p>
    </form>
</x-guest-layout>
