<x-guest-layout>
    <x-slot name="title">Daftar — EduMind</x-slot>

    <div class="mb-7">
        <h2 class="font-serif text-2xl font-bold mb-1" style="color: var(--text-primary);">
            Buat Akun Baru ✨
        </h2>
        <p class="text-sm" style="color: var(--text-secondary);">
            Gratis selamanya · Tidak perlu kartu kredit
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                Nama Lengkap
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="form-input w-full {{ $errors->has('name') ? 'error' : '' }}"
                   placeholder="Nama lengkapmu">
            @error('name')
                <p class="mt-1 text-xs" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                Alamat Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="form-input w-full {{ $errors->has('email') ? 'error' : '' }}"
                   placeholder="nama@email.com">
            @error('email')
                <p class="mt-1 text-xs" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                Password
            </label>
            <input id="password" type="password" name="password" required
                   class="form-input w-full {{ $errors->has('password') ? 'error' : '' }}"
                   placeholder="Minimal 8 karakter">
            @error('password')
                <p class="mt-1 text-xs" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                Konfirmasi Password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="form-input w-full"
                   placeholder="Ulangi password">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary w-full justify-center py-3 text-sm">
            Daftar Sekarang — Gratis →
        </button>

        <div class="relative flex items-center gap-3">
            <div class="flex-1 h-px" style="background: var(--border-strong);"></div>
            <span class="text-xs" style="color: var(--text-muted);">atau</span>
            <div class="flex-1 h-px" style="background: var(--border-strong);"></div>
        </div>

        <p class="text-center text-sm" style="color: var(--text-secondary);">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium hover:underline" style="color: var(--primary-600);">
                Masuk di sini
            </a>
        </p>
    </form>
</x-guest-layout>
