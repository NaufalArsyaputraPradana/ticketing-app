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

    @php
        $isExpired = $event->waktu->isPast();
        $totalStock = $event->tickets->sum('stok');
        $isOutOfStock = $totalStock <= 0;
        $canOrder = !$isExpired && !$isOutOfStock && auth()->check();
    @endphp

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <div class="text-sm breadcrumbs mb-6">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li class="text-gray-600">{{ $event->judul }}</li>
                </ul>
            </div>

            <!-- Event Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Event Image & Title -->
                    <div class="card bg-white shadow-xl">
                        <figure class="h-96 bg-gray-200">
                            <img src="{{ $event->gambar ? (filter_var($event->gambar, FILTER_VALIDATE_URL) ? $event->gambar : asset('images/events/' . $event->gambar)) : asset('images/konser.jpeg') }}"
                                alt="{{ $event->judul }}" class="w-full h-full object-cover" />
                        </figure>
                        <div class="card-body">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h1 class="text-4xl font-bold mb-2">{{ $event->judul }}</h1>
                                    <div class="badge badge-primary badge-lg">{{ $event->category->nama ?? 'Umum' }}
                                    </div>
                                </div>
                                @if ($isExpired)
                                    <div class="badge badge-error badge-lg gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Event Berakhir
                                    </div>
                                @elseif($isOutOfStock)
                                    <div class="badge badge-warning badge-lg gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Tiket Habis
                                    </div>
                                @endif
                            </div>

                            <div class="divider"></div>

                            <!-- Event Info -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg">
                                    <div class="bg-primary/10 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal</p>
                                        <p class="font-bold">
                                            {{ $event->waktu->locale('id')->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg">
                                    <div class="bg-primary/10 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Waktu</p>
                                        <p class="font-bold">{{ $event->waktu->format('H:i') }} WIB</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg">
                                    <div class="bg-primary/10 p-3 rounded-lg">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Lokasi</p>
                                        <p class="font-bold">{{ $event->lokasi }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <!-- Description -->
                            <div>
                                <h3 class="text-xl font-bold mb-3">Deskripsi Event</h3>
                                <p class="text-gray-700 whitespace-pre-line">{{ $event->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Ticket Order -->
                <div class="lg:col-span-1">
                    <div class="card bg-white shadow-xl sticky top-24">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4">Pilih Tiket</h2>

                            @if ($isExpired)
                                <div class="alert alert-error">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Event sudah berakhir</span>
                                </div>
                            @elseif($isOutOfStock)
                                <div class="alert alert-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>Tiket sudah habis</span>
                                </div>
                            @elseif(!auth()->check())
                                <div class="alert alert-info">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Login untuk membeli tiket</span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('login') }}" class="btn btn-primary flex-1">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-outline flex-1">Register</a>
                                </div>
                            @else
                                <form id="order-form">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                                    <div class="space-y-4">
                                        @foreach ($event->tickets as $ticket)
                                            <div
                                                class="border border-gray-200 rounded-lg p-4 hover:border-primary transition-colors">
                                                <div class="flex justify-between items-start mb-2">
                                                    <div>
                                                        <h3 class="font-bold text-lg">{{ ucfirst($ticket->type) }}
                                                        </h3>
                                                        <p class="text-2xl font-bold text-primary">Rp
                                                            {{ number_format($ticket->harga, 0, ',', '.') }}</p>
                                                    </div>
                                                    <div class="badge badge-outline">
                                                        Sisa: {{ $ticket->stok }}
                                                    </div>
                                                </div>
                                                @if ($ticket->stok > 0)
                                                    <div class="flex items-center gap-2 mt-3">
                                                        <button type="button"
                                                            class="btn btn-sm btn-circle btn-outline"
                                                            onclick="decreaseQty({{ $ticket->id }})">-</button>
                                                        <input type="number" id="qty-{{ $ticket->id }}"
                                                            name="items[{{ $ticket->id }}][jumlah]" value="0"
                                                            min="0" max="{{ $ticket->stok }}"
                                                            class="input input-bordered input-sm w-20 text-center"
                                                            onchange="updateTotal()">
                                                        <input type="hidden"
                                                            name="items[{{ $ticket->id }}][ticket_id]"
                                                            value="{{ $ticket->id }}">
                                                        <button type="button"
                                                            class="btn btn-sm btn-circle btn-outline"
                                                            onclick="increaseQty({{ $ticket->id }}, {{ $ticket->stok }})">+</button>
                                                    </div>
                                                @else
                                                    <div class="badge badge-error badge-sm mt-2">Habis</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="divider"></div>

                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-lg font-semibold">Total:</span>
                                        <span id="total-price" class="text-2xl font-bold text-primary">Rp 0</span>
                                    </div>

                                    <button type="button" class="btn btn-primary w-full btn-lg"
                                        onclick="openCheckoutModal()" id="checkout-btn" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Checkout
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Confirmation Modal -->
    <dialog id="checkout_modal" class="modal">
        <div class="modal-box max-w-lg">
            <h3 class="font-bold text-2xl mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Konfirmasi Pembelian
            </h3>
            <p class="text-gray-600 mb-4">Mohon periksa kembali detail pesanan Anda sebelum melanjutkan pembayaran.</p>

            <div class="divider my-2"></div>

            <!-- Event Info Summary -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4 mb-4 border border-blue-200">
                <div class="flex items-start gap-3">
                    <div class="bg-primary/10 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-lg text-gray-800">{{ $event->judul }}</h4>
                        <div class="flex items-center gap-2 text-sm text-gray-600 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $event->waktu->locale('id')->translatedFormat('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            <span>{{ $event->lokasi }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Summary -->
            <div class="bg-white rounded-lg border border-gray-200 p-4 mb-4">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Detail Tiket
                </h4>
                <div id="modal-summary" class="space-y-2">
                    <!-- Summary will be inserted here by JavaScript -->
                </div>
            </div>

            <!-- Total Price -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg p-4 mb-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">Total Pembayaran:</span>
                    <span id="modal-total-price" class="text-2xl font-bold">Rp 0</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="modal-action mt-6">
                <form method="dialog" class="flex-1">
                    <button class="btn btn-outline w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                </form>
                <button type="button" class="btn btn-primary flex-1" id="confirmCheckout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Konfirmasi & Bayar
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    @if ($canOrder)
        <script>
            const tickets = @json(
                $event->tickets->map(function ($t) {
                    return ['id' => $t->id, 'harga' => $t->harga, 'stok' => $t->stok];
                }));

            function increaseQty(ticketId, maxStock) {
                const input = document.getElementById(`qty-${ticketId}`);
                const currentValue = parseInt(input.value);
                if (currentValue < maxStock) {
                    input.value = currentValue + 1;
                    updateTotal();
                }
            }

            function decreaseQty(ticketId) {
                const input = document.getElementById(`qty-${ticketId}`);
                const currentValue = parseInt(input.value);
                if (currentValue > 0) {
                    input.value = currentValue - 1;
                    updateTotal();
                }
            }

            function updateTotal() {
                let total = 0;
                let hasItems = false;

                tickets.forEach(ticket => {
                    const qty = parseInt(document.getElementById(`qty-${ticket.id}`).value) || 0;
                    if (qty > 0) {
                        hasItems = true;
                        total += ticket.harga * qty;
                    }
                });

                document.getElementById('total-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
                document.getElementById('checkout-btn').disabled = !hasItems;
            }

            function openCheckoutModal() {
                // Build summary
                let summaryHTML = '';
                let total = 0;

                tickets.forEach(ticket => {
                    const qty = parseInt(document.getElementById(`qty-${ticket.id}`).value) || 0;
                    if (qty > 0) {
                        const ticketTotal = ticket.harga * qty;
                        total += ticketTotal;

                        // Find ticket type name from DOM
                        const ticketElement = document.querySelector(`input[name="items[${ticket.id}][ticket_id]"]`);
                        const ticketCard = ticketElement.closest('.border');
                        const ticketName = ticketCard.querySelector('h3').textContent;

                        summaryHTML += `
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">${ticketName}</p>
                                <p class="text-sm text-gray-500">Rp ${ticket.harga.toLocaleString('id-ID')} x ${qty}</p>
                            </div>
                            <p class="font-bold text-gray-800">Rp ${ticketTotal.toLocaleString('id-ID')}</p>
                        </div>
                    `;
                    }
                });

                document.getElementById('modal-summary').innerHTML = summaryHTML;
                document.getElementById('modal-total-price').textContent = 'Rp ' + total.toLocaleString('id-ID');

                document.getElementById('checkout_modal').showModal();
            }

            document.getElementById('confirmCheckout').addEventListener('click', async function() {
                const items = [];

                tickets.forEach(ticket => {
                    const qty = parseInt(document.getElementById(`qty-${ticket.id}`).value) || 0;
                    if (qty > 0) {
                        items.push({
                            ticket_id: ticket.id,
                            jumlah: qty
                        });
                    }
                });

                if (items.length === 0) {
                    alert('Pilih minimal 1 tiket!');
                    return;
                }

                const data = {
                    event_id: {{ $event->id }},
                    items: items
                };

                // Disable button and show loading
                const btn = this;
                const originalHTML = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Memproses...';

                try {
                    const response = await fetch('{{ route('orders.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (result.ok) {
                        // Close modal
                        document.getElementById('checkout_modal').close();

                        // Show success toast
                        const toast = document.createElement('div');
                        toast.className = 'toast toast-top toast-end z-50';
                        toast.innerHTML = `
                        <div class="alert alert-success shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Pesanan berhasil dibuat! Mengarahkan ke halaman pembayaran...</span>
                        </div>
                    `;
                        document.body.appendChild(toast);

                        // Redirect after short delay
                        setTimeout(() => {
                            window.location.href = result.redirect;
                        }, 1500);
                    } else {
                        // Close modal
                        document.getElementById('checkout_modal').close();

                        // Show error toast
                        const toast = document.createElement('div');
                        toast.className = 'toast toast-top toast-end z-50';
                        toast.innerHTML = `
                        <div class="alert alert-error shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>${result.message}</span>
                        </div>
                    `;
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 4000);

                        // Re-enable button
                        btn.disabled = false;
                        btn.innerHTML = originalHTML;
                    }
                } catch (error) {
                    // Close modal
                    document.getElementById('checkout_modal').close();

                    // Show error toast
                    const toast = document.createElement('div');
                    toast.className = 'toast toast-top toast-end z-50';
                    toast.innerHTML = `
                    <div class="alert alert-error shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Terjadi kesalahan. Silakan coba lagi.</span>
                    </div>
                `;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 4000);

                    // Re-enable button
                    btn.disabled = false;
                    btn.innerHTML = originalHTML;
                }
            });
        </script>
    @endif
</x-layouts.app>
