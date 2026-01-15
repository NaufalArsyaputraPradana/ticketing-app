<x-layouts.admin title="Manajemen Event">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Event</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola event Anda</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary gap-2 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Event
            </a>
        </div>

        <!-- Table Card -->
        <div class="overflow-x-auto rounded-xl bg-white shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Daftar Event</h2>
            </div>
            <table class="table table-zebra">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center w-16">No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Stok Tiket</th>
                        <th class="text-center w-64">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $index => $event)
                        <tr class="hover">
                            <th class="text-center">
                                <span class="badge badge-ghost">{{ $index + 1 }}</span>
                            </th>
                            <td>
                                @if ($event->gambar)
                                    <div class="avatar">
                                        <div class="w-16 h-16 rounded">
                                            <img src="{{ asset('images/events/' . $event->gambar) }}" alt="{{ $event->judul }}" class="object-cover">
                                        </div>
                                    </div>
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="font-medium">{{ $event->judul }}</td>
                            <td>
                                <span class="badge badge-outline">{{ $event->kategori->nama ?? '-' }}</span>
                            </td>
                            <td>{{ $event->waktu ? $event->waktu->format('d M Y') : '-' }}</td>
                            <td>{{ $event->lokasi }}</td>
                            <td>
                                @php
                                    $totalStok = $event->tickets_total_stok;
                                    $badgeColor = $totalStok == 0 ? 'badge-error' : ($totalStok < 10 ? 'badge-warning' : 'badge-success');
                                @endphp
                                <span class="badge {{ $badgeColor }} font-bold">{{ $totalStok }}</span>
                            </td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-info gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-secondary gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <button class="btn btn-sm btn-error gap-1" onclick="confirmDelete({{ $event->id }}, '{{ $event->judul }}')">
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
                            <td colspan="8" class="text-center py-8">
                                <div class="text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="font-medium">Tidak ada event tersedia</p>
                                    <p class="text-sm mt-1">Klik "Tambah Event" untuk membuat event baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

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
            setTimeout(() => document.querySelector('.toast')?.remove(), 3000);
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

    <!-- Hidden Delete Form -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete(id, judul) {
            if (confirm(`Apakah Anda yakin ingin menghapus event "${judul}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/events/${id}`;
                form.submit();
            }
        }
    </script>
</x-layouts.admin>
