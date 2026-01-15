<x-layouts.admin title="Detail Event">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Event</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap event dan kelola tiket</p>
        </div>

        <!-- Event Details Card -->
        <div class="rounded-xl bg-white shadow-lg mb-6">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Informasi Event</h2>
            </div>
            <div class="p-6 space-y-6">
                <!-- Gambar Event -->
                @if ($event->gambar)
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">Gambar Event</span>
                        </label>
                        <div class="max-w-md">
                            <div class="rounded-lg border-2 border-gray-200 overflow-hidden shadow-md">
                                <img src="{{ asset('images/events/' . $event->gambar) }}" 
                                     alt="{{ $event->judul }}" 
                                     class="w-full h-auto object-cover">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Judul Event -->
                <div class="form-control">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">Judul Event</span>
                    </label>
                    <input type="text" 
                           value="{{ $event->judul }}" 
                           class="input input-bordered w-full border-2 bg-base-200" 
                           readonly />
                </div>

                <!-- Deskripsi -->
                <div class="form-control">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">Deskripsi</span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24 w-full border-2 bg-base-200" 
                              readonly>{{ $event->deskripsi }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal & Waktu -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">Tanggal & Waktu</span>
                        </label>
                        <input type="text" 
                               value="{{ $event->waktu->format('d M Y, H:i') }}" 
                               class="input input-bordered w-full border-2 bg-base-200" 
                               readonly />
                    </div>

                    <!-- Kategori -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">Kategori</span>
                        </label>
                        <input type="text" 
                               value="{{ $event->kategori->nama ?? '-' }}" 
                               class="input input-bordered w-full border-2 bg-base-200" 
                               readonly />
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="form-control">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">Lokasi</span>
                    </label>
                    <input type="text" 
                           value="{{ $event->lokasi }}" 
                           class="input input-bordered w-full border-2 bg-base-200" 
                           readonly />
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2 justify-end pt-6 mt-6 border-t border-gray-200">
                    <button type="button" class="btn btn-ghost gap-2 px-6" onclick="window.location.href='{{ route('admin.events.index') }}'">
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary gap-2 px-6" onclick="window.location.href='{{ route('admin.events.edit', $event->id) }}'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Event
                    </button>
                </div>
            </div>
        </div>

        <!-- Tickets Section -->
        <div class="rounded-xl bg-white shadow-lg">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="font-semibold text-gray-700">Daftar Tiket</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola tiket event</p>
                </div>
                <button onclick="add_ticket_modal.showModal()" class="btn btn-primary gap-2 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Tiket
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-center w-16">No</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-center w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $index => $ticket)
                            <tr class="hover">
                                <th class="text-center">
                                    <span class="badge badge-ghost">{{ $index + 1 }}</span>
                                </th>
                                <td>
                                    <span class="badge badge-primary">{{ ucfirst($ticket->type) }}</span>
                                </td>
                                <td class="font-medium">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $badgeColor = $ticket->stok == 0 ? 'badge-error' : ($ticket->stok < 10 ? 'badge-warning' : 'badge-success');
                                    @endphp
                                    <span class="badge {{ $badgeColor }} font-bold">{{ $ticket->stok }}</span>
                                </td>
                                <td>
                                    <div class="flex gap-2 justify-center">
                                        <button class="btn btn-sm btn-primary gap-1" 
                                                onclick="openEditModal({{ $ticket->id }}, '{{ $ticket->type }}', {{ $ticket->harga }}, {{ $ticket->stok }})">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-error gap-1" 
                                                onclick="confirmDelete({{ $ticket->id }}, '{{ ucfirst($ticket->type) }}')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8">
                                    <div class="text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                        <p class="font-medium">Tidak ada tiket tersedia</p>
                                        <p class="text-sm mt-1">Klik "Tambah Tiket" untuk membuat tiket baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Ticket Modal -->
    <dialog id="add_ticket_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md border-2 border-gray-200 shadow-xl">
            <form method="post" action="{{ route('admin.tickets.store') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Tambah Tiket</h3>
                    <p class="text-sm text-gray-500 mt-2">Masukkan informasi tiket baru</p>
                </div>

                <!-- Tipe Tiket -->
                <div class="form-control mb-6">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Tipe Tiket <span class="text-error">*</span>
                        </span>
                    </label>
                    <select name="type" class="select select-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" required>
                        <option value="" disabled selected>Pilih Tipe</option>
                        <option value="regular">Regular</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>

                <!-- Harga -->
                <div class="form-control mb-6">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Harga <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="number" 
                           name="harga" 
                           placeholder="Contoh: 100000" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           min="0" 
                           required />
                    <label class="label pt-2">
                        <span class="label-text-alt text-gray-500">
                            Masukkan harga tiket dalam Rupiah
                        </span>
                    </label>
                </div>

                <!-- Stok -->
                <div class="form-control mb-8">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Stok <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="number" 
                           name="stok" 
                           placeholder="Contoh: 100" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           min="0" 
                           required />
                    <label class="label pt-2">
                        <span class="label-text-alt text-gray-500">
                            Jumlah tiket yang tersedia
                        </span>
                    </label>
                </div>

                <div class="modal-action mt-6 pt-4 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary gap-2 px-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                    <button type="button" class="btn btn-ghost gap-2 px-6" onclick="add_ticket_modal.close()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Edit Ticket Modal -->
    <dialog id="edit_ticket_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md border-2 border-gray-200 shadow-xl">
            <form id="editTicketForm" method="post">
                @csrf
                @method('PUT')

                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Edit Tiket</h3>
                    <p class="text-sm text-gray-500 mt-2">Perbarui informasi tiket</p>
                </div>

                <!-- Tipe Tiket -->
                <div class="form-control mb-6">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Tipe Tiket <span class="text-error">*</span>
                        </span>
                    </label>
                    <select id="edit_type" name="type" class="select select-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" required>
                        <option value="" disabled>Pilih Tipe</option>
                        <option value="regular">Regular</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>

                <!-- Harga -->
                <div class="form-control mb-6">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Harga <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="number" 
                           id="edit_harga" 
                           name="harga" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           min="0" 
                           required />
                    <label class="label pt-2">
                        <span class="label-text-alt text-gray-500">
                            Masukkan harga tiket dalam Rupiah
                        </span>
                    </label>
                </div>

                <!-- Stok -->
                <div class="form-control mb-8">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Stok <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="number" 
                           id="edit_stok" 
                           name="stok" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           min="0" 
                           required />
                    <label class="label pt-2">
                        <span class="label-text-alt text-gray-500">
                            Jumlah tiket yang tersedia
                        </span>
                    </label>
                </div>

                <div class="modal-action mt-6 pt-4 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary gap-2 px-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                    <button type="button" class="btn btn-ghost gap-2 px-6" onclick="edit_ticket_modal.close()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Delete Ticket Form (Hidden) -->
    <form id="deleteTicketForm" method="post" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Success/Error Toast -->
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
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
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
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 4000)
        </script>
    @endif

    <script>
        function openEditModal(ticketId, type, harga, stok) {
            const form = document.getElementById('editTicketForm');
            form.action = `/admin/tickets/${ticketId}`;
            
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_stok').value = stok;
            
            edit_ticket_modal.showModal();
        }

        function confirmDelete(ticketId, ticketType) {
            if (confirm(`Apakah Anda yakin ingin menghapus tiket ${ticketType}?`)) {
                const form = document.getElementById('deleteTicketForm');
                form.action = `/admin/tickets/${ticketId}`;
                form.submit();
            }
        }
    </script>
</x-layouts.admin>
