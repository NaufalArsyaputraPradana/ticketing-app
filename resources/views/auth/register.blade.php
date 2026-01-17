<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div
            class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-100 to-cyan-100 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
        <p class="text-gray-500">Daftar untuk mulai memesan tiket event favoritmu</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="form-control">
            <label class="label" for="name">
                <span class="label-text font-semibold text-gray-700">Nama Lengkap</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="name"
                    class="input input-bordered w-full pl-10 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('name') input-error @enderror"
                    placeholder="John Doe" />
            </div>
            @error('name')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-semibold text-gray-700">Email</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    autocomplete="username"
                    class="input input-bordered w-full pl-10 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('email') input-error @enderror"
                    placeholder="nama@email.com" />
            </div>
            @error('email')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-control">
            <label class="label" for="password">
                <span class="label-text font-semibold text-gray-700">Password</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="input input-bordered w-full pl-10 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('password') input-error @enderror"
                    placeholder="••••••••" />
            </div>
            @error('password')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @else
                <label class="label">
                    <span class="label-text-alt text-gray-500">Minimal 8 karakter</span>
                </label>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-control">
            <label class="label" for="password_confirmation">
                <span class="label-text font-semibold text-gray-700">Konfirmasi Password</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password"
                    class="input input-bordered w-full pl-10 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    placeholder="••••••••" />
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="btn w-full btn-lg gap-2 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 border-0 shadow-md hover:shadow-lg transition-all mt-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Daftar
        </button>

        <!-- Login Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="text-teal-600 hover:text-teal-700 font-semibold transition-colors">
                    Login di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
