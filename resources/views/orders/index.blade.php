<x-layouts.app>
    <!-- Toast Notifications -->
    @if (session('success'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        <script>
            setTimeout(() => document.querySelector('.toast')?.remove(), 4000);
        </script>
    @endif

    @if (session('error'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-error shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        <script>
            setTimeout(() => document.querySelector('.toast')?.remove(), 4000);
        </script>
    @endif

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb & Header -->
            <div class="mb-8">
                <div class="text-sm breadcrumbs mb-4">
                    <ul>
                        <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                        <li class="text-gray-600">Pesanan Saya</li>
                    </ul>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">Pesanan Saya</h1>
                        <p class="text-gray-600">Histori pemesanan tiket event Anda</p>
                    </div>
                </div>
            </div>

            <!-- Orders Container -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                <div class="p-6 lg:p-8">
                    @if ($orders->count() > 0)
                        <div class="space-y-6">
                            @foreach ($orders as $order)
                                <div
                                    class="card bg-base-100 shadow-xl border border-gray-200 hover:shadow-2xl transition-shadow">
                                    <div class="card-body">
                                        <!-- Order Header -->
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="card-title text-2xl">{{ $order->event->judul }}</h3>
                                                <div class="flex items-center gap-2 mt-2">
                                                    <span class="badge badge-primary">Order #{{ $order->id }}</span>
                                                    <span
                                                        class="badge badge-ghost">{{ $order->order_date->locale('id')->translatedFormat('d F Y, H:i') }}</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm text-gray-500">Total Pembayaran</p>
                                                <p class="text-2xl font-bold text-primary">Rp
                                                    {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <!-- Event Info -->
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="bg-primary/10 p-2 rounded-lg">
                                                    <svg class="w-5 h-5 text-primary" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500">Tanggal Event</p>
                                                    <p class="font-semibold">
                                                        {{ $order->event->waktu->locale('id')->translatedFormat('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                <div class="bg-primary/10 p-2 rounded-lg">
                                                    <svg class="w-5 h-5 text-primary" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500">Waktu</p>
                                                    <p class="font-semibold">{{ $order->event->waktu->format('H:i') }}
                                                        WIB</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                <div class="bg-primary/10 p-2 rounded-lg">
                                                    <svg class="w-5 h-5 text-primary" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500">Lokasi</p>
                                                    <p class="font-semibold truncate max-w-[200px]">
                                                        {{ $order->event->lokasi }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ticket Details -->
                                        <div class="bg-base-200 rounded-lg p-4">
                                            <h4 class="font-semibold mb-3 flex items-center gap-2">
                                                Detail Tiket
                                            </h4>
                                            @foreach ($order->detailOrders as $detail)
                                                <div class="flex items-center justify-between py-2">
                                                    <div class="flex items-center gap-3">
                                                        <div class="badge badge-lg badge-primary">
                                                            {{ ucfirst($detail->ticket->type) }}</div>
                                                        <span class="text-gray-600">x {{ $detail->jumlah }}</span>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm text-gray-500">@ Rp
                                                            {{ number_format($detail->ticket->harga, 0, ',', '.') }}
                                                        </p>
                                                        <p class="font-bold">Rp
                                                            {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Actions -->
                                        <div class="card-actions justify-end mt-4">
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Lihat Detail
                                            </a>
                                            <a href="{{ route('events.show', $order->event->id) }}"
                                                class="btn btn-ghost">
                                                Info Event
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-500 mb-2">Belum Ada Pesanan</h3>
                            <p class="text-gray-400 mb-6">Anda belum memiliki riwayat pemesanan tiket</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                    </path>
                                </svg>
                                Jelajahi Event
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
