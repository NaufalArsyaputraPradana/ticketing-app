<x-layouts.app>
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

    @if (session('error'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-error shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        <script>
            setTimeout(() => document.querySelector('.toast')?.remove(), 4000);
        </script>
    @endif

    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="text-sm breadcrumbs mb-6">
            <ul>
                <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li class="text-gray-600">{{ $event->judul }}</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Event Image -->
                <div class="mb-6">
                    <img src="{{ asset('images/events/' . $event->gambar) }}" 
                         alt="{{ $event->judul }}"
                         class="w-full h-96 object-cover rounded-lg shadow-lg"
                         onerror="this.src='{{ asset('images/events/default.jpg') }}'">
                </div>

                <!-- Event Info -->
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <h1 class="card-title text-3xl font-bold mb-4">{{ $event->judul }}</h1>
                        
                        <div class="flex flex-wrap gap-4 mb-4">
                            <!-- Date -->
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $event->waktu->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                            </div>

                            <!-- Location -->
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $event->lokasi }}</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <!-- Category Badge -->
                            <span class="badge badge-primary badge-lg">{{ $event->kategori->nama }}</span>
                            
                            <!-- Organizer Badge -->
                            <span class="badge badge-outline badge-lg">{{ $event->user->name }}</span>
                        </div>

                        <!-- Description -->
                        <div class="divider"></div>
                        <h2 class="text-xl font-semibold mb-2">Deskripsi Event</h2>
                        <p class="text-gray-700 whitespace-pre-line">{{ $event->deskripsi }}</p>
                    </div>
                </div>

                <!-- Tickets -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-4">Pilih Tiket</h2>
                        
                        @guest
                        <div class="alert alert-info mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Silakan <a href="{{ route('login') }}" class="link link-primary font-semibold">login</a> terlebih dahulu untuk membeli tiket.</span>
                        </div>
                        @endguest
                        
                        @foreach($event->tickets as $ticket)
                        <div class="border border-gray-200 rounded-lg p-4 mb-4 hover:border-blue-500 transition-colors" id="ticket-{{ $ticket->id }}">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <h3 class="font-semibold text-lg">{{ ucfirst($ticket->type) }}</h3>
                                    <p class="text-sm text-gray-500">Stok tersedia: <span id="stock-{{ $ticket->id }}">{{ $ticket->stok }}</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center gap-2">
                                    <button type="button" 
                                            class="btn btn-sm btn-circle btn-outline"
                                            onclick="decrementTicket({{ $ticket->id }})"
                                            id="dec-{{ $ticket->id }}"
                                            @guest disabled @endguest>
                                        -
                                    </button>
                                    <input type="number" 
                                           id="qty-{{ $ticket->id }}" 
                                           value="0" 
                                           min="0" 
                                           max="{{ $ticket->stok }}"
                                           class="input input-bordered input-sm w-20 text-center"
                                           onchange="updateTicketQuantity({{ $ticket->id }})"
                                           @guest disabled @endguest>
                                    <button type="button" 
                                            class="btn btn-sm btn-circle btn-outline"
                                            onclick="incrementTicket({{ $ticket->id }})"
                                            id="inc-{{ $ticket->id }}"
                                            @guest disabled @endguest>
                                        +
                                    </button>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Subtotal:</p>
                                    <p class="text-lg font-semibold" id="subtotal-{{ $ticket->id }}">Rp 0</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar Summary -->
            <div class="lg:col-span-1">
                <div class="card bg-base-100 shadow-xl sticky top-4">
                    <div class="card-body">
                        <h2 class="card-title text-xl mb-4">Ringkasan Pembelian</h2>
                        
                        <div class="mb-4" id="selected-tickets">
                            <p class="text-gray-500 text-center py-4">Belum ada tiket dipilih</p>
                        </div>

                        <div class="divider"></div>

                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Total Item:</span>
                            <span class="font-semibold" id="total-items">0</span>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-semibold">Total Harga:</span>
                            <span class="text-2xl font-bold text-blue-600" id="total-price">Rp 0</span>
                        </div>

                        @auth
                        <button type="button" 
                                class="btn btn-primary w-full" 
                                onclick="openCheckoutModal()"
                                id="checkout-btn"
                                disabled>
                            Checkout
                        </button>
                        @else
                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-3">Silakan login untuk melanjutkan pembelian</p>
                            <a href="{{ route('login') }}" class="btn btn-primary w-full">
                                Login untuk Checkout
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <dialog id="checkout_modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Konfirmasi Pembelian</h3>
            <p class="py-4">Apakah Anda yakin ingin melanjutkan pembelian?</p>
            
            <div class="bg-gray-100 rounded-lg p-4 mb-4" id="modal-summary">
                <!-- Summary will be inserted here -->
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Batal</button>
                </form>
                <button type="button" class="btn btn-primary" id="confirmCheckout">
                    Konfirmasi Pembelian
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        // Ticket data from backend
        const tickets = [
            @foreach($event->tickets as $ticket)
            {
                id: {{ $ticket->id }},
                type: '{{ $ticket->type }}',
                harga: {{ $ticket->harga }},
                stok: {{ $ticket->stok }}
            },
            @endforeach
        ];

        const eventId = {{ $event->id }};

        // Update summary
        function updateSummary() {
            let totalItems = 0;
            let totalPrice = 0;
            let selectedHtml = '';
            let hasSelection = false;

            tickets.forEach(ticket => {
                const qty = parseInt(document.getElementById(`qty-${ticket.id}`).value) || 0;
                if (qty > 0) {
                    hasSelection = true;
                    totalItems += qty;
                    const subtotal = qty * ticket.harga;
                    totalPrice += subtotal;

                    selectedHtml += `
                        <div class="flex justify-between items-center mb-2 text-sm">
                            <div>
                                <p class="font-semibold">${ticket.type}</p>
                                <p class="text-gray-500">${qty} x Rp ${ticket.harga.toLocaleString('id-ID')}</p>
                            </div>
                            <p class="font-semibold">Rp ${subtotal.toLocaleString('id-ID')}</p>
                        </div>
                    `;
                }
            });

            // Update sidebar
            document.getElementById('total-items').textContent = totalItems;
            document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            
            if (hasSelection) {
                document.getElementById('selected-tickets').innerHTML = selectedHtml;
                document.getElementById('checkout-btn').disabled = false;
            } else {
                document.getElementById('selected-tickets').innerHTML = '<p class="text-gray-500 text-center py-4">Belum ada tiket dipilih</p>';
                document.getElementById('checkout-btn').disabled = true;
            }
        }

        // Update ticket subtotal
        function updateTicketSubtotal(ticketId) {
            const ticket = tickets.find(t => t.id === ticketId);
            const qty = parseInt(document.getElementById(`qty-${ticketId}`).value) || 0;
            const subtotal = qty * ticket.harga;
            document.getElementById(`subtotal-${ticketId}`).textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        }

        // Increment ticket quantity
        function incrementTicket(ticketId) {
            const ticket = tickets.find(t => t.id === ticketId);
            const input = document.getElementById(`qty-${ticketId}`);
            let qty = parseInt(input.value) || 0;
            
            if (qty < ticket.stok) {
                qty++;
                input.value = qty;
                updateTicketSubtotal(ticketId);
                updateSummary();
            }
        }

        // Decrement ticket quantity
        function decrementTicket(ticketId) {
            const input = document.getElementById(`qty-${ticketId}`);
            let qty = parseInt(input.value) || 0;
            
            if (qty > 0) {
                qty--;
                input.value = qty;
                updateTicketSubtotal(ticketId);
                updateSummary();
            }
        }

        // Update quantity from input
        function updateTicketQuantity(ticketId) {
            const ticket = tickets.find(t => t.id === ticketId);
            const input = document.getElementById(`qty-${ticketId}`);
            let qty = parseInt(input.value) || 0;
            
            // Validate
            if (qty < 0) qty = 0;
            if (qty > ticket.stok) qty = ticket.stok;
            
            input.value = qty;
            updateTicketSubtotal(ticketId);
            updateSummary();
        }

        // Open checkout modal
        function openCheckoutModal() {
            // Build modal summary
            let summaryHtml = '';
            let totalPrice = 0;

            tickets.forEach(ticket => {
                const qty = parseInt(document.getElementById(`qty-${ticket.id}`).value) || 0;
                if (qty > 0) {
                    const subtotal = qty * ticket.harga;
                    totalPrice += subtotal;
                    summaryHtml += `
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <p class="font-semibold">${ticket.type}</p>
                                <p class="text-sm text-gray-600">${qty} tiket x Rp ${ticket.harga.toLocaleString('id-ID')}</p>
                            </div>
                            <p class="font-semibold">Rp ${subtotal.toLocaleString('id-ID')}</p>
                        </div>
                    `;
                }
            });

            summaryHtml += `
                <div class="divider my-2"></div>
                <div class="flex justify-between items-center">
                    <p class="text-lg font-bold">Total:</p>
                    <p class="text-xl font-bold text-blue-600">Rp ${totalPrice.toLocaleString('id-ID')}</p>
                </div>
            `;

            document.getElementById('modal-summary').innerHTML = summaryHtml;
            document.getElementById('checkout_modal').showModal();
        }

        // Confirm checkout - Event listener with async/await
        document.getElementById('confirmCheckout').addEventListener('click', async () => {
            const btn = document.getElementById('confirmCheckout');
            btn.setAttribute('disabled', 'disabled');
            btn.textContent = 'Memproses...';

            // Collect selected tickets into items array
            const items = [];
            tickets.forEach(ticket => {
                const qty = Number(document.getElementById(`qty-${ticket.id}`).value || 0);
                if (qty > 0) {
                    items.push({
                        ticket_id: ticket.id,
                        jumlah: qty
                    });
                }
            });

            // Validate
            if (items.length === 0) {
                showToast('Silakan pilih tiket terlebih dahulu', 'error');
                btn.removeAttribute('disabled');
                btn.textContent = 'Konfirmasi Pembelian';
                return;
            }

            try {
                const res = await fetch('{{ route("orders.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        event_id: {{ $event->id }},
                        items: items
                    })
                });

                // Handle unauthenticated
                if (res.status === 401) {
                    window.location.href = '{{ route("login") }}';
                    return;
                }

                if (!res.ok) {
                    const text = await res.text();
                    throw new Error(text || 'Gagal membuat pesanan');
                }

                const data = await res.json();
                
                // Redirect to orders page where success message will be shown
                window.location.href = data.redirect || '{{ route("orders.index") }}';

            } catch (err) {
                console.error('Error:', err);
                showToast('Terjadi kesalahan: ' + err.message, 'error');
                btn.removeAttribute('disabled');
                btn.textContent = 'Konfirmasi Pembelian';
                document.getElementById('checkout_modal').close();
            }
        });

        // Show toast notification
        function showToast(message, type = 'success') {
            // Remove existing toast
            const existingToast = document.querySelector('.toast');
            if (existingToast) {
                existingToast.remove();
            }

            // Determine icon and alert class
            let icon, alertClass;
            if (type === 'success') {
                alertClass = 'alert-success';
                icon = `<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>`;
            } else {
                alertClass = 'alert-error';
                icon = `<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>`;
            }

            // Create toast
            const toast = document.createElement('div');
            toast.className = 'toast toast-top toast-end z-50';
            toast.innerHTML = `
                <div class="alert ${alertClass} shadow-lg">
                    ${icon}
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(toast);

            // Auto remove after 4 seconds
            setTimeout(() => toast.remove(), 4000);
        }
    </script>
</x-layouts.app>
