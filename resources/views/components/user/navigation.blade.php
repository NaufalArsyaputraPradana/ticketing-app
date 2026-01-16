<div class="navbar bg-white shadow-md sticky top-0 z-50 px-4 lg:px-8">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('home') }}">Home</a></li>
                @auth
                    <li><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                @endauth
            </ul>
        </div>
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix Logo" class="h-10 lg:h-12" />
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <form action="{{ route('home') }}" method="GET" class="relative">
            <div class="relative flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    class="input input-bordered pl-12 pr-24 w-96 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all" 
                    placeholder="Cari event, lokasi, kategori..." 
                    value="{{ request('search') }}" 
                />
                <button type="submit" class="btn btn-sm absolute right-2 rounded-full gap-2 px-4" style="background: linear-gradient(to right, #0d9488, #0891b2); color: white; border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </div>
        </form>
    </div>
    <div class="navbar-end gap-2">
        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #0d9488, #0891b2); color: white;">
                        <span class="text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow-lg bg-white rounded-box w-60 border border-gray-200">
                    <li class="menu-title px-4 py-3 border-b border-gray-100">
                        <div class="flex flex-col">
                            <span class="text-gray-900 font-semibold">{{ Auth::user()->name }}</span>
                            <small class="text-xs text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" class="flex items-center gap-3 py-2 text-gray-700 hover:bg-teal-50 hover:text-teal-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Pesanan Saya
                        </a>
                    </li>
                    @if(Auth::user()->role === 'admin')
                        <div class="divider my-1"></div>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-2 text-teal-700 hover:bg-teal-50 hover:text-teal-900 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Admin Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 py-2 text-gray-700 hover:bg-teal-50 hover:text-teal-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 py-2 text-gray-700 hover:bg-teal-50 hover:text-teal-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>
                        </li>
                    @endif
                    <div class="divider my-1"></div>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 py-2 w-full text-left text-red-600 hover:bg-red-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-ghost hover:bg-teal-50 hover:text-teal-700">Login</a>
            <a href="{{ route('register') }}" class="btn text-white" style="background: linear-gradient(to right, #0d9488, #0891b2); border: none;">Register</a>
        @endauth
    </div>
</div>