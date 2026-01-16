<x-layouts.app>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="text-sm breadcrumbs mb-6">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li><a href="{{ route('orders.index') }}" class="text-primary hover:underline">Pesanan Saya</a></li>
                    <li class="text-gray-600">Detail Order #{{ $order->id }}</li>
                </ul>
            </div>

            <!-- Header -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Detail Pemesanan</h1>
                    <p class="text-gray-600">Order ID: #{{ $order->id }}</p>
                </div>
                <div class="badge badge-primary badge-lg">
                    {{ $order->order_date->locale('id')->translatedFormat('d F Y, H:i') }} WIB
                </div>
            </div>

            <!-- Main Card -->
            <div class="card bg-white shadow-xl mb-6">
                <div class="card-body p-0">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <!-- Event Image & Info -->
                        <div class="lg:col-span-1 p-6 bg-gradient-to-br from-blue-50 to-purple-50">
                            <div class="relative h-64 rounded-lg overflow-hidden mb-4 shadow-md">
                                <img
                                    src="{{ $order->event?->gambar ? (filter_var($order->event->gambar, FILTER_VALIDATE_URL) ? $order->event->gambar : asset('images/events/' . $order->event->gambar)) : asset('images/konser.jpeg') }}"
                                    alt="{{ $order->event?->judul ?? 'Event' }}" 
                                    class="w-full h-full object-cover" />
                            </div>
                            <h2 class="font-bold text-2xl mb-3 text-gray-800">{{ $order->event?->judul ?? 'Event' }}</h2>
                            
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="bg-primary/10 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Event</p>
                                        <p class="font-semibold">{{ $order->event?->waktu->locale('id')->translatedFormat('d F Y, H:i') ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <div class="bg-primary/10 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Lokasi</p>
                                        <p class="font-semibold">{{ $order->event?->lokasi ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="lg:col-span-2 p-6 lg:p-8">
                            <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Rincian Tiket
                            </h3>

                            <div class="space-y-4 mb-6">
                                @foreach($order->detailOrders as $detail)
                                    <div class="flex items-center justify-between p-4 bg-base-200 rounded-lg hover:bg-base-300 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="avatar placeholder">
                                                <div class="bg-primary text-white rounded-lg w-16 h-16 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-bold text-lg">{{ ucfirst($detail->ticket->type) }}</p>
                                                <p class="text-sm text-gray-500">Jumlah: {{ $detail->jumlah }} tiket</p>
                                                <p class="text-sm text-gray-500">@ Rp {{ number_format($detail->ticket->harga, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                                            <p class="font-bold text-xl text-primary">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="divider"></div>

                            <!-- Total -->
                            <div class="bg-gradient-to-r from-primary/10 to-purple-100 rounded-lg p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                                        <p class="text-4xl font-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="badge badge-success badge-lg gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Berhasil
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">{{ $order->order_date->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Buyer Info -->
                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <h4 class="font-semibold mb-2 text-gray-700">Informasi Pembeli</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <p class="text-gray-500">Nama</p>
                                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Email</p>
                                        <p class="font-semibold">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-between">
                <a href="{{ route('orders.index') }}" class="btn btn-outline btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Pesanan
                </a>
                <a href="{{ route('events.show', $order->event->id) }}" class="btn btn-primary btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Lihat Info Event
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
