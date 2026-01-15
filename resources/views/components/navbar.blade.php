<div class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
        </div>
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix Logo" class="h-8" />
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <input class="input input-bordered w-72" placeholder="Cari Event..." />
    </div>
    <div class="navbar-end gap-2">
        @auth
            <!-- User sudah login -->
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full bg-blue-900 text-white flex items-center justify-center">
                        <span class="text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li class="menu-title">
                        <span>{{ Auth::user()->name }}</span>
                    </li>
                    <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                    @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- User belum login -->
            <a href="{{ route('login') }}" class="btn bg-blue-900 text-white hover:bg-blue-800">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline text-blue-900 hover:bg-blue-900 hover:text-white">Register</a>
        @endauth
    </div>
</div>