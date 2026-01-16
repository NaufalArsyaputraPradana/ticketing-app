<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="flex min-h-full flex-col items-start bg-gradient-to-b from-blue-900 to-blue-800 text-white w-64 is-drawer-close:w-14 is-drawer-open:w-80 shadow-2xl">
        <div class="w-full flex items-center justify-center p-6 border-b border-blue-700">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="Logo" class="h-10">
                
            </a>
        </div>

        <!-- Sidebar content here -->
        <ul class="menu w-full grow gap-2 p-4">
            <!-- Dashboard Item -->
            <li>
                <a href="{{ route('admin.dashboard') }}" 
                   class="is-drawer-close:tooltip is-drawer-close:tooltip-right hover:bg-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}" 
                   data-tip="Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                    </svg>
                    <span class="is-drawer-close:hidden">Dashboard</span>
                </a>
            </li>

            <div class="divider is-drawer-close:hidden text-blue-400 text-xs my-2">MANAJEMEN</div>

            <!-- Kategori item -->
            <li>
                <a href="{{ route('admin.categories.index') }}" 
                   class="is-drawer-close:tooltip is-drawer-close:tooltip-right hover:bg-blue-700 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-700' : '' }}" 
                   data-tip="Kategori">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                    </svg>
                    <span class="is-drawer-close:hidden">Kategori</span>
                </a>
            </li>

            <!-- Event item -->
            <li>
                <a href="{{ route('admin.events.index') }}" 
                   class="is-drawer-close:tooltip is-drawer-close:tooltip-right hover:bg-blue-700 {{ request()->routeIs('admin.events.*') ? 'bg-blue-700' : '' }}" 
                   data-tip="Event">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-4V7a2 2 0 0 1 2-2" />
                    </svg>
                    <span class="is-drawer-close:hidden">Event</span>
                </a>
            </li>

            <div class="divider is-drawer-close:hidden text-blue-400 text-xs my-2">LAPORAN</div>

            <!-- History item -->
            <li>
                <a href="{{ route('admin.histories.index') }}" 
                   class="is-drawer-close:tooltip is-drawer-close:tooltip-right hover:bg-blue-700 {{ request()->routeIs('admin.histories.*') ? 'bg-blue-700' : '' }}" 
                   data-tip="History">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span class="is-drawer-close:hidden">History Pembelian</span>
                </a>
            </li>
        </ul>

        <!-- Bottom Actions -->
        <div class="w-full p-4 border-t border-blue-700 space-y-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-error btn-sm w-full is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 21q-.825 0-1.413-.587T3 19V5q0-.825.588-1.413T5 3h7v2H5v14h7v2H5zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5l-5 5z"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>
