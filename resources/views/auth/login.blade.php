<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-100 to-cyan-100 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang Kembali!</h2>
        <p class="text-gray-500">Login untuk melanjutkan ke BengTix</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-6 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-semibold text-gray-700">Email</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                       class="input input-bordered w-full pl-10 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('password') input-error @enderror" 
                       placeholder="••••••••" />
            </div>
            @error('password')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-sm">
            <label class="label cursor-pointer gap-2 justify-start p-0">
                <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-sm border-2" />
                <span class="label-text text-gray-600">Ingat Saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-teal-600 hover:text-teal-700 font-medium transition-colors">
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn w-full btn-lg gap-2 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white border-0 shadow-md hover:shadow-lg transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Login
        </button>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-700 font-semibold transition-colors">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
