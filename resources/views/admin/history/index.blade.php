<x-layouts.admin title="History Pembelian">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">History Pembelian</h1>
            <p class="text-sm text-gray-500 mt-1">Riwayat transaksi pembelian tiket</p>
        </div>

        <!-- Table Card -->
        <div class="overflow-x-auto rounded-xl bg-white shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Daftar Transaksi</h2>
            </div>
            <table class="table table-zebra">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center w-16">No</th>
                        <th>Nama Pembeli</th>
                        <th>Event</th>
                        <th>Tanggal Pembelian</th>
                        <th>Total Harga</th>
                        <th class="text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $index => $history)
                        <tr class="hover">
                            <th class="text-center">
                                <span class="badge badge-ghost">{{ $index + 1 }}</span>
                            </th>
                            <td class="font-medium">{{ $history->user->name }}</td>
                            <td>{{ $history->event?->judul ?? '-' }}</td>
                            <td>{{ $history->created_at->format('d M Y, H:i') }}</td>
                            <td class="font-semibold text-green-600">Rp {{ number_format($history->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.histories.show', $history->id) }}" class="btn btn-sm btn-info gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-medium">Tidak ada history pembelian tersedia</p>
                                    <p class="text-sm mt-1">Belum ada transaksi yang tercatat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
