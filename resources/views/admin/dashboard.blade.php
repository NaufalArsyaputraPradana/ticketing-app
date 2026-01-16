<x-layouts.admin title="Dashboard Admin">
    <!-- Toast Notifications -->
    @if (session('success'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        <script>
            setTimeout(() => document.querySelector('.toast')?.remove(), 4000);
        </script>
    @endif

    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
            <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}! Kelola event dan transaksi Anda di sini.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Event Card -->
            <div class="card bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-xl hover:shadow-2xl transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wide">Total Event</h2>
                            <p class="font-bold text-5xl mt-2">{{ $totalEvents ?? 0 }}</p>
                            <p class="text-xs mt-2 opacity-75">Event terdaftar</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-4V7a2 2 0 0 1 2-2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Kategori Card -->
            <div class="card bg-gradient-to-br from-green-500 to-green-700 text-white shadow-xl hover:shadow-2xl transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wide">Total Kategori</h2>
                            <p class="font-bold text-5xl mt-2">{{ $totalCategories ?? 0 }}</p>
                            <p class="text-xs mt-2 opacity-75">Kategori tersedia</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi Card -->
            <div class="card bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-xl hover:shadow-2xl transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wide">Total Transaksi</h2>
                            <p class="font-bold text-5xl mt-2">{{ $totalOrders ?? 0 }}</p>
                            <p class="text-xs mt-2 opacity-75">Pesanan masuk</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2s-.9-2-2-2M1 2v2h2l3.6 7.59l-1.35 2.45c-.16.28-.25.61-.25.96c0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12l.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1.003 1.003 0 0 0 20 4H5.21l-.94-2M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2s2-.9 2-2s-.9-2-2-2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="card bg-gradient-to-br from-orange-500 to-orange-700 text-white shadow-xl hover:shadow-2xl transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold opacity-90 uppercase tracking-wide">Total Pendapatan</h2>
                            <p class="font-bold text-3xl mt-2">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs mt-2 opacity-75">Dari semua transaksi</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card bg-white shadow-xl mb-10">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Quick Actions
                </h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-success btn-lg min-w-[200px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Kelola Kategori
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-info btn-lg min-w-[200px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Kelola Event
                    </a>
                    <a href="{{ route('admin.histories.index') }}" class="btn btn-warning btn-lg min-w-[200px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Lihat History
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                    Aktivitas Terbaru
                </h2>
                <div class="divider"></div>
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                            <div class="flex items-center justify-between p-4 bg-base-200 rounded-lg hover:bg-base-300 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="avatar placeholder">
                                        <div class="bg-primary text-white rounded-full w-12">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $order->user->name }}</p>
                                        <p class="text-sm text-gray-600">Membeli tiket {{ $order->event->judul }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    <a href="{{ route('admin.histories.show', $order->id) }}" class="btn btn-ghost btn-xs">Detail</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Belum ada aktivitas terbaru</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
