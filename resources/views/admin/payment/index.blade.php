<x-layouts.admin title="Manajemen Kategori">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Tipe Pembayaran</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola tipe pembayaran anda</p>
            </div>
            <button class="btn btn-primary gap-2 shadow-md hover:shadow-lg" onclick="add_modal.showModal()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Tipe Pembayaran
            </button>
        </div>

        <!-- Table Card -->
        <div class="overflow-x-auto rounded-xl bg-white shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Daftar Tipe Pembayaran</h2>
            </div>
            <table class="table table-zebra">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center w-16">No</th>
                        <th>Tipe Pembayaran</th>
                        <th class="text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $index => $payment)
                        <tr class="hover">
                            <th class="text-center">
                                <span class="badge badge-ghost">{{ $index + 1 }}</span>
                            </th>
                            <td class="font-medium">{{ $payment->payment_method }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <button class="btn btn-sm btn-info gap-1" 
                                            onclick="openEditModal({{ $payment->id }}, '{{ $payment->payment_method }}')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-error gap-1" 
                                            onclick="openDeleteModal({{ $payment->id }}, '{{ $payment->payment_method }}')">
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
                            <td colspan="3" class="text-center py-8">
                                <div class="text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="font-medium">Tidak ada tipe pembayaran tersedia</p>
                                    <p class="text-sm mt-1">Klik "Tambah Tipe Pembayaran" untuk membuat tipe pembayaran baru</p>
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

    @if ($errors->any())
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-warning shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <div class="font-bold">Validasi Gagal!</div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => document.querySelector('.toast')?.remove(), 5000);
        </script>
    @endif

    <!-- Add payment Modal -->
    <dialog id="add_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md border-2 border-gray-200 shadow-xl">
            <form method="POST" action="{{ route('admin.payments.store') }}">
                @csrf
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Tambah Tipe Pembayaran</h3>
                    <p class="text-sm text-gray-500 mt-2">Masukkan informasi tipe pembayaran baru</p>
                </div>
                
                <div class="form-control w-full mb-8">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Tipe Pembayaran <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           placeholder="Contoh: Transfer Bank BRI, E-Wallet Gopay, Cash" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           name="payment_method" 
                           required 
                           minlength="3"
                           maxlength="255" />
                    <label class="label pt-2">
                        <span class="label-text-alt text-gray-500">
                            Minimal 3 karakter, maksimal 255 karakter
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
                    <button type="button" class="btn btn-ghost gap-2 px-6" onclick="add_modal.close()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Edit payment Modal -->
    <dialog id="edit_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md border-2 border-gray-200 shadow-xl">
            <form method="POST" id="edit_form">
                @csrf
                @method('PUT')
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Edit Tipe Pembayaran</h3>
                    <p class="text-sm text-gray-500 mt-2">Perbarui informasi tipe pembayaran</p>
                </div>
                
                <div class="form-control w-full mb-8">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Tipe Pembayaran <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           placeholder="Masukkan tipe pembayaran" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           id="edit_payment_name" 
                           name="payment_method" 
                           required 
                           minlength="3"
                           maxlength="255" />
                    <label class="label pt-2">
                        <span class="label-text-alt text-gray-500">
                            Minimal 3 karakter, maksimal 255 karakter
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
                    <button type="button" class="btn btn-ghost gap-2 px-6" onclick="edit_modal.close()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Hidden Delete Form -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Delete Confirmation Modal -->
    <dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box border-2 border-error shadow-xl">
            <div class="mb-6 pb-4 border-b border-error/20">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-error/10 rounded-full">
                        <svg class="w-6 h-6 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Konfirmasi Hapus</h3>
                        <p class="text-sm text-gray-500 mt-1">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <p class="text-gray-700 mb-2">Apakah Anda yakin ingin menghapus kategori:</p>
                <div class="p-4 bg-error/5 border-l-4 border-error rounded-r">
                    <p class="font-bold text-gray-800" id="delete_payment_name"></p>
                </div>
                <p class="text-sm text-gray-500 mt-3">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Data yang sudah dihapus tidak dapat dikembalikan.
                </p>
            </div>
            
            <div class="modal-action mt-6 pt-4 border-t border-gray-200">
                <button type="button" class="btn btn-ghost gap-2 px-6" onclick="delete_modal.close()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </button>
                <button type="button" class="btn btn-error gap-2 px-6" onclick="confirmDelete()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Ya, Hapus
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        let deleteId = null;

        function openDeleteModal(id, payment_method) {
            deleteId = id;
            document.getElementById('delete_payment_name').textContent = payment_method;
            delete_modal.showModal();
        }

        function confirmDelete() {
            if (deleteId) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/payments/${deleteId}`;
                form.submit();
            }
        }

        function openEditModal(id, payment_method) {
            const form = document.getElementById('edit_form');
            document.getElementById('edit_payment_name').value = payment_method;
            form.action = `/admin/payments/${id}`;
            edit_modal.showModal();
        }
    </script>

</x-layouts.admin>
