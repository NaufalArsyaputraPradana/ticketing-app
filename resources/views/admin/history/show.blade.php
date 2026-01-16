<x-layouts.admin title="Detail Pemesanan">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Pemesanan</h1>
            <p class="text-sm text-gray-500 mt-1">Order #{{ $order->id }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>

        <!-- Main Card -->
        <div class="rounded-xl bg-white shadow-lg">
            <div class="lg:flex">
                <!-- Event Image & Info Section -->
                <div class="lg:w-1/3 p-6 border-b lg:border-b-0 lg:border-r border-gray-100">
                    @if($order->event?->gambar)
                        <div class="rounded-lg border-2 border-gray-200 overflow-hidden shadow-md mb-4">
                            <img src="{{ asset('images/events/' . $order->event->gambar) }}" 
                                 alt="{{ $order->event->judul }}" 
                                 class="w-full h-64 object-cover" />
                        </div>
                    @else
                        <div class="w-full h-64 bg-gray-100 rounded-lg border-2 border-gray-200 flex items-center justify-center mb-4">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <h2 class="font-bold text-xl text-gray-800 mb-3">{{ $order->event?->judul ?? 'Event' }}</h2>
                    
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $order->event?->lokasi ?? '-' }}</span>
                        </p>
                        
                        @if($order->event?->waktu)
                            <p class="text-sm text-gray-600 flex items-start gap-2">
                                <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $order->event->waktu->format('d M Y, H:i') }} WIB</span>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Order Details Section -->
                <div class="lg:w-2/3 p-6 space-y-6">
                    <!-- Customer Info -->
                    <div class="p-4 bg-base-200 rounded-lg border-2 border-gray-200">
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Data Pemesan
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Nama:</span>
                                <span class="text-sm font-medium">{{ $order->user?->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Email:</span>
                                <span class="text-sm font-medium">{{ $order->user?->email ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal Order:</span>
                                <span class="text-sm font-medium">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tickets Detail -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                            Detail Tiket
                        </h3>

                        <div class="space-y-3">
                            @foreach($order->detailOrders as $detail)
                                <div class="flex justify-between items-center p-3 bg-base-200 rounded-lg border-2 border-gray-200 hover:border-primary transition-colors">
                                    <div>
                                        <div class="font-bold text-primary">
                                            <span class="badge badge-primary">{{ ucfirst($detail->ticket->type) }}</span>
                                        </div>
                                        <div class="text-sm text-gray-600 mt-1">
                                            Rp {{ number_format($detail->ticket->harga, 0, ',', '.') }} × {{ $detail->jumlah }} tiket
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-lg text-gray-800">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Total Payment -->
                    <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border-2 border-green-200">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-gray-800 flex items-center gap-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Total Pembayaran
                            </span>
                            <span class="font-bold text-2xl text-green-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2 justify-end pt-6 mt-6 border-t border-gray-200">
                        <a href="{{ route('admin.histories.index') }}" class="btn btn-ghost gap-2 px-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
