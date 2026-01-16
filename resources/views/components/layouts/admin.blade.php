<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Admin Panel - BengTix' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS & DaisyUI -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col min-h-screen bg-base-200">
            <!-- Navbar -->
            @include('components.admin.navigation')

            <!-- Page content here -->
            <div class="flex-1 overflow-auto">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <footer class="footer footer-center bg-base-300 text-base-content p-4">
                <aside>
                    <p>Copyright © {{ date('Y') }} BengTix - All rights reserved</p>
                </aside>
            </footer>
        </div>
        
        @include('components.admin.sidebar')
    </div>
</body>

</html>
