<div class="drawer-side is-drawer-close:overflow-visible z-50">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
    <div
        class="flex min-h-full flex-col items-start bg-gradient-to-br from-teal-600 via-cyan-600 to-blue-700 text-white w-72 is-drawer-close:w-20 is-drawer-open:w-72 shadow-2xl backdrop-blur-sm relative overflow-hidden">

        <!-- Decorative Background Elements -->
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -left-16 top-40 w-48 h-48 bg-cyan-400/10 rounded-full blur-2xl"></div>
        <div class="absolute right-0 bottom-20 w-40 h-40 bg-blue-400/10 rounded-full blur-2xl"></div>

        <!-- Logo & Brand Section -->
        <div class="w-full flex items-center justify-between p-6 border-b border-white/20 backdrop-blur-sm bg-white/5">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="Logo" class="h-20">
            </a>
        </div>

        <!-- Sidebar content here -->
        <ul class="relative menu w-full grow gap-2 p-4">
            <!-- Dashboard Item -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="Dashboard">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">Dashboard</span>
                    </div>
                    @if (request()->routeIs('admin.dashboard'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>

            <div class="is-drawer-close:hidden">
                <div class="flex items-center gap-2 px-2 mt-4 mb-2">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                    <span class="text-xs font-semibold text-cyan-100 tracking-wider uppercase">Manajemen</span>
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                </div>
            </div>

            <!-- Kategori item -->
            <li>
                <a href="{{ route('admin.categories.index') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="Kategori">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">Kategori</span>
                    </div>
                    @if (request()->routeIs('admin.categories.*'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>

            <!-- Event item -->
            <li>
                <a href="{{ route('admin.events.index') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.events.*') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="Event">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.events.*') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-4V7a2 2 0 0 1 2-2" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">Event</span>
                    </div>
                    @if (request()->routeIs('admin.events.*'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>

            <!-- Pembayaran item -->
            <li>
                <a href="{{ route('admin.payments.index') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.payments.*') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="Pembayaran">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.payments.*') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">Pembayaran</span>
                    </div>
                    @if (request()->routeIs('admin.payments.*'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>

            <!-- Ticket Type item -->
            <li>
                <a href="{{ route('admin.ticket-types.index') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.ticket-types.*') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="Tipe Tiket">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.ticket-types.*') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16v16H4z" />
                                    <path d="M9 9h6v6H9z" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">Tipe Tiket</span>
                    </div>
                    @if (request()->routeIs('admin.ticket-types.*'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>

            <!-- Location item -->
            <li>
                <a href="{{ route('admin.locations.index') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.locations.*') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="Lokasi">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.locations.*') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5z" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">Lokasi</span>
                    </div>
                    @if (request()->routeIs('admin.locations.*'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>
            

            <div class="is-drawer-close:hidden">
                <div class="flex items-center gap-2 px-2 mt-4 mb-2">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                    <span class="text-xs font-semibold text-cyan-100 tracking-wider uppercase">Laporan</span>
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                </div>
            </div>

            <!-- History item -->
            <li>
                <a href="{{ route('admin.histories.index') }}"
                    class="group relative is-drawer-close:tooltip is-drawer-close:tooltip-right rounded-xl transition-all duration-300 {{ request()->routeIs('admin.histories.*') ? 'bg-white/20 shadow-lg shadow-white/10' : 'hover:bg-white/10' }}"
                    data-tip="History">
                    <div class="flex items-center gap-3 w-full">
                        <div class="relative flex-shrink-0">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div
                                class="relative p-2 bg-white/10 rounded-lg {{ request()->routeIs('admin.histories.*') ? 'bg-white/20' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                        </div>
                        <span class="is-drawer-close:hidden font-medium">History Pembelian</span>
                    </div>
                    @if (request()->routeIs('admin.histories.*'))
                        <div
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full shadow-lg shadow-white/50">
                        </div>
                    @endif
                </a>
            </li>
        </ul>

        <!-- Bottom Actions -->
        <div class="relative w-full p-4 border-t border-white/20 backdrop-blur-sm bg-white/5">
            <!-- Admin Info (Optional) -->
            <div class="is-drawer-close:hidden mb-3 p-3 bg-white/10 rounded-xl backdrop-blur-sm border border-white/20">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-teal-400 to-blue-500 rounded-full blur-md opacity-50">
                        </div>
                        <div
                            class="relative w-10 h-10 bg-gradient-to-br from-teal-500 to-blue-600 rounded-full flex items-center justify-center ring-2 ring-white/30 shadow-lg">
                            <span class="text-white font-bold text-sm">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-cyan-100 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 12.75c1.63 0 3.07.39 4.24.9c1.08.48 1.76 1.56 1.76 2.73V18H6v-1.61c0-1.18.68-2.26 1.76-2.73c1.17-.52 2.61-.91 4.24-.91M4 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2m1.13 1.1c-.37-.06-.74-.1-1.13-.1c-.99 0-1.93.21-2.78.58A2.01 2.01 0 0 0 0 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29M20 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2m4 3.43c0-.81-.48-1.53-1.22-1.85A6.95 6.95 0 0 0 20 14c-.39 0-.76.04-1.13.1c.4.68.63 1.46.63 2.29V18H24v-1.57M12 6c1.66 0 3 1.34 3 3s-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3" />
                            </svg>
                            <span>Administrator</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="group relative w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Logout">
                    <!-- Animated background -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-600 to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Content -->
                    <div class="relative flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor" class="group-hover:rotate-12 transition-transform duration-300">
                            <path
                                d="M5 21q-.825 0-1.413-.587T3 19V5q0-.825.588-1.413T5 3h7v2H5v14h7v2H5zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5l-5 5z" />
                        </svg>
                        <span class="is-drawer-close:hidden">Logout</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>
