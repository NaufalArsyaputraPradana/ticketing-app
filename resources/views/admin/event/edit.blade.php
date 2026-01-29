<x-layouts.admin title="Edit Event">
    <div class="container mx-auto p-6 lg:p-10">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Event</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi event</p>
        </div>

        <!-- Form Card -->
        <div class="rounded-xl bg-white shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Form Edit Event</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Event -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">
                                Judul Event <span class="text-error">*</span>
                            </span>
                        </label>
                        <input type="text" 
                               name="judul" 
                               placeholder="Contoh: Konser Musik Rock" 
                               class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                               value="{{ old('judul', $event->judul) }}"
                               required 
                               minlength="3"
                               maxlength="255" />
                        <label class="label pt-2">
                            <span class="label-text-alt text-gray-500">
                                Minimal 3 karakter, maksimal 255 karakter
                            </span>
                        </label>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">
                                Deskripsi <span class="text-error">*</span>
                            </span>
                        </label>
                        <textarea name="deskripsi" 
                                  placeholder="Deskripsi lengkap tentang event..." 
                                  class="textarea textarea-bordered h-24 w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                                  required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                        <label class="label pt-2">
                            <span class="label-text-alt text-gray-500">
                                Jelaskan detail event Anda
                            </span>
                        </label>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">
                                Tanggal & Waktu <span class="text-error">*</span>
                            </span>
                        </label>
                        <input type="datetime-local" 
                               name="waktu" 
                               class="input input-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                               value="{{ old('waktu', $event->waktu->format('Y-m-d\TH:i')) }}"
                               required />
                        <label class="label pt-2">
                            <span class="label-text-alt text-gray-500">
                                Pilih tanggal dan waktu pelaksanaan event
                            </span>
                        </label>
                    </div>

                    <!-- Lokasi -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">
                                Lokasi <span class="text-error">*</span>
                            </span>
                        </label>
                        <select name="location_id" class="select select-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" required>
                            <option value="" disabled>Pilih Lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id', $event->location_id) == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <label class="label pt-2">
                            <span class="label-text-alt text-gray-500">
                                Pilih lokasi event dari daftar lokasi yang tersedia
                            </span>
                        </label>
                    </div>

                    <!-- Kategori -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">
                                Kategori <span class="text-error">*</span>
                            </span>
                        </label>
                        <select name="category_id" 
                                class="select select-bordered w-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 border-2" 
                                required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                        <label class="label pt-2">
                            <span class="label-text-alt text-gray-500">
                                Pilih kategori yang sesuai dengan event
                            </span>
                        </label>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">Gambar Event</span>
                        </label>
                        <input type="file" 
                               name="gambar" 
                               id="gambarInput"
                               accept="image/*" 
                               class="file-input file-input-bordered w-full border-2" 
                               onchange="previewImage(event)" />
                        <label class="label pt-2">
                            <span class="label-text-alt text-gray-500">
                                Format: JPG, PNG, GIF, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.
                            </span>
                        </label>
                    </div>

                    <!-- Preview Gambar -->
                    <div id="imagePreview" class="form-control">
                        <label class="label pb-2">
                            <span class="label-text font-semibold text-gray-700">
                                {{ $event->gambar ? 'Gambar Saat Ini' : 'Preview Gambar' }}
                            </span>
                        </label>
                        <div class="max-w-md">
                            <div class="rounded-lg border-2 border-gray-200 overflow-hidden shadow-md">
                                @if ($event->gambar)
                                    <img id="previewImg" 
                                         src="{{ asset('images/events/' . $event->gambar) }}" 
                                         alt="Event Image" 
                                         class="w-full h-auto object-cover">
                                @else
                                    <div class="bg-gray-100 flex items-center justify-center h-48">
                                        <span class="text-gray-400">Belum ada gambar</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Action -->
                    <div class="flex gap-2 justify-end pt-6 mt-6 border-t border-gray-200">
                        <button type="button" class="btn btn-ghost gap-2 px-6" onclick="window.location.href='{{ route('admin.events.index') }}'">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary gap-2 px-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notifications -->
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

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewImg = document.getElementById('previewImg');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layouts.admin>
