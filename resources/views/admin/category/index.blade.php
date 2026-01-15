<x-layouts.admin title="Manajemen Kategori">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Kategori</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola kategori event Anda</p>
            </div>
            <button class="btn btn-primary gap-2 shadow-md hover:shadow-lg" onclick="add_modal.showModal()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Kategori
            </button>
        </div>

        <!-- Table Card -->
        <div class="overflow-x-auto rounded-xl bg-white shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Daftar Kategori</h2>
            </div>
            <table class="table table-zebra">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center w-16">No</th>
                        <th>Nama Kategori</th>
                        <th class="text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr class="hover">
                            <th class="text-center">
                                <span class="badge badge-ghost">{{ $index + 1 }}</span>
                            </th>
                            <td class="font-medium">{{ $category->nama }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <button class="btn btn-sm btn-info gap-1" 
                                            onclick="openEditModal({{ $category->id }}, '{{ $category->nama }}')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-error gap-1" 
                                            onclick="confirmDelete({{ $category->id }}, '{{ $category->nama }}')">
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
                                    <p class="font-medium">Tidak ada kategori tersedia</p>
                                    <p class="text-sm mt-1">Klik "Tambah Kategori" untuk membuat kategori baru</p>
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

    <!-- Add Category Modal -->
    <dialog id="add_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md border-2 border-gray-200 shadow-xl">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Tambah Kategori</h3>
                    <p class="text-sm text-gray-500 mt-2">Masukkan informasi kategori baru</p>
                </div>
                
                <div class="form-control w-full mb-8">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Nama Kategori <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           placeholder="Contoh: Musik, Olahraga, Teknologi" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           name="nama" 
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

    <!-- Edit Category Modal -->
    <dialog id="edit_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md border-2 border-gray-200 shadow-xl">
            <form method="POST" id="edit_form">
                @csrf
                @method('PUT')
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Edit Kategori</h3>
                    <p class="text-sm text-gray-500 mt-2">Perbarui informasi kategori</p>
                </div>
                
                <div class="form-control w-full mb-8">
                    <label class="label pb-2">
                        <span class="label-text font-semibold text-gray-700">
                            Nama Kategori <span class="text-error">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           placeholder="Masukkan nama kategori" 
                           class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                           id="edit_category_name" 
                           name="nama" 
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

    <script>
        function openEditModal(id, nama) {
            const form = document.getElementById('edit_form');
            document.getElementById('edit_category_name').value = nama;
            form.action = `/admin/categories/${id}`;
            edit_modal.showModal();
        }

        function confirmDelete(id, nama) {
            if (confirm(`Apakah Anda yakin ingin menghapus kategori "${nama}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/categories/${id}`;
                form.submit();
            }
        }
    </script>

</x-layouts.admin>
