<x-layouts.admin title="Dashboard Admin">
    <!-- Toast Notifications -->
    @if (session('success'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-success shadow-lg bg-green-50 border-green-200 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        <script>
            setTimeout(() => document.querySelector('.toast')?.remove(), 4000);
        </script>
    @endif

    <div class="container mx-auto p-6 lg:p-10 animate-fade-in">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
                    <p class="text-gray-600 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Selamat datang, <span class="font-semibold text-teal-700">{{ Auth::user()->name }}</span>!
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="badge badge-lg bg-teal-50 text-teal-700 border-teal-200 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Event Card -->
            <div class="card bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 animate-scale-in border-0">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wider mb-2">Total Event</h2>
                        <p class="font-bold text-5xl mb-2">{{ $totalEvents ?? 0 }}</p>
                        <p class="text-sm opacity-80 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Event terdaftar
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Kategori Card -->
            <div class="card bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 animate-scale-in border-0" style="animation-delay: 0.1s;">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wider mb-2">Total Kategori</h2>
                        <p class="font-bold text-5xl mb-2">{{ $totalCategories ?? 0 }}</p>
                        <p class="text-sm opacity-80 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Kategori tersedia
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi Card -->
            <div class="card bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 animate-scale-in border-0" style="animation-delay: 0.2s;">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wider mb-2">Total Transaksi</h2>
                        <p class="font-bold text-5xl mb-2">{{ $totalOrders ?? 0 }}</p>
                        <p class="text-sm opacity-80 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Pesanan masuk
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="card bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 text-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 animate-scale-in border-0" style="animation-delay: 0.3s;">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wider mb-2">Total Pendapatan</h2>
                        <p class="font-bold text-3xl mb-2">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                        <p class="text-sm opacity-80 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Dari semua transaksi
                        </p>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Recent Activity -->
        <div class="card bg-white shadow-xl border border-gray-100 rounded-2xl">
            <div class="card-body p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="p-2 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        Aktivitas Terbaru
                    </h2>
                    @if(isset($recentOrders) && $recentOrders->count() > 0)
                        <a href="{{ route('admin.histories.index') }}" class="text-sm text-teal-600 hover:text-teal-700 font-medium flex items-center gap-1">
                            Lihat Semua
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
                
                <div class="divider my-0"></div>
                
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    <div class="space-y-3 mt-6">
                        @foreach($recentOrders as $order)
                            <div class="group flex items-center justify-between p-5 bg-gradient-to-r from-gray-50 to-gray-50/50 hover:from-teal-50 hover:to-cyan-50 rounded-xl transition-all duration-300 border border-gray-100 hover:border-teal-200 hover:shadow-md">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="avatar placeholder">
                                        
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-800 flex items-center gap-2">
                                            {{ $order->user->name }}
                                            <span class="badge badge-xs bg-teal-100 text-teal-700 border-teal-200">{{ $order->user->role }}</span>
                                        </p>
                                        <p class="text-sm text-gray-600 flex items-center gap-2 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                            <span class="truncate">Membeli tiket <span class="font-medium">{{ $order->event->judul }}</span></span>
                                        </p>
                                        <p class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $order->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-right">
                                        <p class="font-bold text-lg bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-gray-500">Total</p>
                                    </div>
                                    <a href="{{ route('admin.histories.show', $order->id) }}" class="btn btn-sm bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 border-0 shadow-sm hover:shadow-md transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada aktivitas terbaru</p>
                        <p class="text-sm text-gray-400 mt-1">Transaksi akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
