<x-layouts.app>
    <!-- Hero Section -->
    <div class="hero relative overflow-hidden" style="background: linear-gradient(135deg, #0d9488 0%, #0891b2 50%, #2563eb 100%); min-height: 600px;">
        <!-- Decorative Elements -->
        <div class="absolute inset-0" style="opacity: 0.1;">
            <div class="absolute rounded-full" style="top: 5rem; left: 2.5rem; width: 18rem; height: 18rem; background: white; filter: blur(80px);"></div>
            <div class="absolute rounded-full" style="bottom: 5rem; right: 2.5rem; width: 24rem; height: 24rem; background: white; filter: blur(80px);"></div>
        </div>
        
        <div class="hero-content text-center relative px-4" style="color: white; z-index: 10;">
            <div style="max-width: 56rem; margin: 0 auto;">
                <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1.5rem; filter: drop-shadow(0 10px 8px rgb(0 0 0 / 0.04)) drop-shadow(0 4px 3px rgb(0 0 0 / 0.1));">
                    Hi, Amankan Tiketmu yuk.
                </h1>
                <p style="font-size: 1.25rem; margin-bottom: 2rem; color: #f0fdfa; filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.07)) drop-shadow(0 2px 2px rgb(0 0 0 / 0.06));">
                    BengTix: Beli tiket, auto asik.
                </p>
                <div style="display: flex; flex-direction: column; gap: 1rem; justify-content: center;">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-lg" style="background: white; color: #0d9488; border: none; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); padding: 0.75rem 2rem; border-radius: 0.5rem; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; font-weight: 600;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="height: 1.25rem; width: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            Mulai Pesan Tiket
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-lg" style="color: white; border: 2px solid white; background: transparent; padding: 0.75rem 2rem; border-radius: 0.5rem; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-weight: 600;">
                            Login
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <section style="max-width: 80rem; margin: 0 auto; padding: 4rem 1.5rem; background: white;">
        <!-- Section Header -->
        <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: flex-start; gap: 1.5rem; margin-bottom: 2.5rem;">
            <div>
                <h2 style="font-size: 2.25rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">
                    <span style="background: linear-gradient(to right, #0d9488, #0891b2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Event Terbaru</span>
                </h2>
                <p style="color: #4b5563;">Temukan event favoritmu dan pesan tiketnya sekarang</p>
            </div>
            
            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home') }}">
                    <x-user.category-pill :label="'Semua'" :active="!request('kategori')" />
                </a>
                @foreach($categories as $kategori)
                <a href="{{ route('home', ['kategori' => $kategori->id]) }}">
                    <x-user.category-pill :label="$kategori->nama" :active="request('kategori') == $kategori->id" />
                </a>
                @endforeach
            </div>
        </div>

        <!-- Events Grid -->
        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($events as $event)
                <x-user.event-card 
                    :title="$event->judul" 
                    :date="$event->waktu" 
                    :location="$event->lokasi"
                    :price="$event->tickets_min_harga" 
                    :image="$event->gambar" 
                    :href="route('events.show', $event)" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div style="text-center; padding: 5rem 0;">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 6rem; height: 6rem; background: linear-gradient(135deg, #f0fdfa, #ecfeff); border-radius: 9999px; margin-bottom: 1.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 3rem; width: 3rem; color: #2dd4bf;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Tidak Ada Event</h3>
                <p style="color: #4b5563;">Belum ada event yang tersedia saat ini. Coba kategori lain atau kembali lagi nanti.</p>
            </div>
        @endif
    </section>

    <!-- Call to Action Section -->
    @guest
    <section style="background: linear-gradient(to right, #0d9488, #0891b2, #2563eb); padding: 5rem 1.5rem;">
        <div style="max-width: 56rem; margin: 0 auto; text-align: center; color: white;">
            <h2 style="font-size: 2.25rem; font-weight: 700; margin-bottom: 1rem; filter: drop-shadow(0 10px 8px rgb(0 0 0 / 0.04)) drop-shadow(0 4px 3px rgb(0 0 0 / 0.1));">Siap untuk Pengalaman Event yang Menakjubkan?</h2>
            <p style="font-size: 1.25rem; color: #f0fdfa; margin-bottom: 2rem; filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.07)) drop-shadow(0 2px 2px rgb(0 0 0 / 0.06));">Daftar sekarang dan dapatkan akses ke berbagai event menarik</p>
            <div style="display: flex; flex-direction: column; gap: 1rem; justify-content: center;">
                <a href="{{ route('register') }}" style="background: white; color: #0d9488; border: none; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); padding: 0.75rem 2rem; border-radius: 0.5rem; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; font-weight: 600; font-size: 1.125rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 1.25rem; width: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Daftar Gratis
                </a>
            </div>
        </div>
    </section>
    @endguest
</x-layouts.app>