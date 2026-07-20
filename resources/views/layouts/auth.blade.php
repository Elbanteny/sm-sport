<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication') - SM Sport Center</title>
    
    <!-- Tailwind v4 Engine & Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 text-zinc-100 antialiased min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 relative overflow-hidden">

    <!-- Background Gradients & Mesh -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(163,230,53,0.08),rgba(255,255,255,0))] pointer-events-none"></div>
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-lime-400/5 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo Brand -->
        <div class="mb-8 flex justify-center">
            <a class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center font-syne font-black text-zinc-950 text-xl transform group-hover:rotate-6 transition-transform duration-300 shadow-[0_0_20px_rgba(163,230,53,0.3)]">
                    SM
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-syne text-xl font-bold tracking-tight text-white group-hover:text-lime-400 transition-colors duration-300">SM SPORT</span>
                    <span class="text-[10px] text-zinc-400 uppercase tracking-widest -mt-0.5">Center & Arena</span>
                </div>
            </a>
        </div>

        <!-- Kartu Box Form Kredensial (Glassmorphic Style) -->
        <div class="w-full rounded-3xl bg-zinc-900/40 border border-zinc-800/80 p-6 sm:p-8 backdrop-blur-md shadow-2xl">
            @yield('content')
        </div>
    </div>

</body>
</html>