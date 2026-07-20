<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'SM Sport Center - Reservasi Lapangan Olahraga Premium')</title>
        
        <!-- Google Fonts: Plus Jakarta Sans & Syne for sporty headlines -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
        
        <!-- Tailwind CSS & JS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js for interactivity -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @stack('styles')
    </head>
    <body class="bg-zinc-950 text-zinc-100 antialiased selection:bg-lime-400 selection:text-black overflow-x-hidden">

        <!-- Top Notification Bar -->
        <div class="bg-linear-to-r from-lime-400 to-emerald-500 text-zinc-950 text-xs font-semibold py-2 px-4 text-center tracking-wide uppercase">
            ⚡ Promo Member Baru: Dapatkan diskon 20% untuk booking lapangan pertama Anda!
        </div>

        <x-user.header />

        <!-- Main Content Area -->
        <main>
            @yield('content')
        </main>
        
        <x-user.footer />

        @stack('scripts')
    </body>
</html>
