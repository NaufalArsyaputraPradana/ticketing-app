<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BengTix') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
        }
        .guest-container {
            display: flex;
            min-height: 100vh;
            background-color: #f9fafb;
        }
        .guest-sidebar {
            display: none;
            width: 50%;
            background: linear-gradient(135deg, #0d9488 0%, #0891b2 50%, #2563eb 100%);
            padding: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .guest-sidebar::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        .guest-content {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: #f9fafb;
        }
        @media (min-width: 1024px) {
            .guest-sidebar {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .guest-content {
                width: 50%;
            }
        }
        .feature-box {
            padding: 1.5rem;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }
        .feature-box:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(8px);
        }
    </style>
</head>
<body>
    <div class="guest-container">
        <!-- Left Side - Branding -->
        <div class="guest-sidebar">
            <div style="max-width: 28rem;">
                <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix Logo" style="height: 4rem; margin-bottom: 2rem;" />
                <h1 style="font-size: 2.25rem; font-weight: 700; margin-bottom: 1rem;">Selamat Datang di BengTix</h1>
                <p style="font-size: 1.25rem; color: #f0fdfa; margin-bottom: 2rem;">Platform pemesanan tiket event terpercaya. Beli tiket, auto asik!</p>
                
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div class="feature-box">
                            <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; margin-bottom: 0.25rem;">Mudah & Cepat</h3>
                            <p style="font-size: 0.875rem; color: #f0fdfa;">Pesan tiket hanya dalam hitungan menit</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div class="feature-box">
                            <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; margin-bottom: 0.25rem;">Aman & Terpercaya</h3>
                            <p style="font-size: 0.875rem; color: #f0fdfa;">Transaksi dijamin aman dan terverifikasi</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div class="feature-box">
                            <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; margin-bottom: 0.25rem;">Berbagai Event</h3>
                            <p style="font-size: 0.875rem; color: #f0fdfa;">Pilihan event konser, seminar, dan workshop</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="guest-content">
            <div style="width: 100%; max-width: 28rem;">
                <!-- Mobile Logo -->
                <div style="text-align: center; margin-bottom: 2rem; display: block;">
                    <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix Logo" style="height: 3rem; margin: 0 auto;" class="lg:hidden" />
                </div>

                <!-- Card Container -->
                <div style="background: white; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1); padding: 2rem;">
                    {{ $slot }}
                </div>

                <!-- Back to Home -->
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="{{ route('home') }}" style="color: #0d9488; font-size: 0.875rem; text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="height: 1rem; width: 1rem; display: inline; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
