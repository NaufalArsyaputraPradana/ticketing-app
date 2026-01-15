<x-layouts.admin title="Dashboard Admin">
    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-semibold mb-8">Dashboard Admin</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-5">
            <!-- Total Event Card -->
            <div class="card bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="card-title text-lg opacity-90">Total Event</h2>
                            <p class="font-bold text-5xl mt-2">{{ $totalEvents ?? 0 }}</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-4V7a2 2 0 0 1 2-2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Kategori Card -->
            <div class="card bg-gradient-to-br from-green-500 to-green-700 text-white shadow-lg">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="card-title text-lg opacity-90">Total Kategori</h2>
                            <p class="font-bold text-5xl mt-2">{{ $totalCategories ?? 0 }}</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi Card -->
            <div class="card bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-lg">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="card-title text-lg opacity-90">Total Transaksi</h2>
                            <p class="font-bold text-5xl mt-2">{{ $totalOrders ?? 0 }}</p>
                        </div>
                        <div class="text-6xl opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2s-.9-2-2-2M1 2v2h2l3.6 7.59l-1.35 2.45c-.16.28-.25.61-.25.96c0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12l.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1.003 1.003 0 0 0 20 4H5.21l-.94-2M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2s2-.9 2-2s-.9-2-2-2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Quick Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.events.create') }}" class="btn btn-outline btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14m-7-7h14" />
                    </svg>
                    Tambah Event
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                    </svg>
                    Kelola Kategori
                </a>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline btn-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-4V7a2 2 0 0 1 2-2" />
                    </svg>
                    Kelola Event
                </a>
                <a href="{{ route('admin.histories.index') }}" class="btn btn-outline btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                    Lihat History
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
