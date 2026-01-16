<div class="navbar bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="navbar-start">
        <!-- Mobile Menu Button -->
        <label for="admin-drawer" class="btn btn-ghost drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </label>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3">
            <span class="text-xl font-bold text-blue-900">Admin Panel</span>
        </a>
    </div>
    
    <div class="navbar-end gap-2">

        <!-- User Dropdown -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full bg-gradient-to-br from-blue-900 to-blue-700 text-white flex items-center justify-center shadow-md">
                    <span class="text-lg font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
            </label>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow-lg menu menu-sm dropdown-content bg-white rounded-box w-60 border border-gray-200">
                <li class="menu-title px-4 py-3 border-b border-gray-100">
                    <div class="flex flex-col">
                        <span class="text-gray-900 font-semibold">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-gray-500">{{ Auth::user()->email }}</span>
                    </div>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="flex items-center gap-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Halaman User
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil
                    </a>
                </li>
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
    </div>
</div>
