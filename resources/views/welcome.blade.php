<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katering Kita - Solusi Makan Siang Kantor</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased font-[Figtree] text-gray-900 bg-gray-50">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <div
                        class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-indigo-200 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-indigo-900">Katering<span
                            class="text-indigo-500">Kita</span></span>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-6 py-2.5 bg-indigo-600 text-white rounded-full font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-600 font-semibold hover:text-indigo-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-6 py-2.5 bg-indigo-600 text-white rounded-full font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">Daftar
                                    Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="relative overflow-hidden py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:w-2/3">
                <span
                    class="inline-block px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-sm font-bold tracking-wide uppercase mb-6">Marketplace
                    Katering #1</span>
                <h1 class="text-5xl lg:text-7xl font-extrabold text-indigo-950 leading-tight mb-8">
                    Makan Siang <span class="text-indigo-600">Kantor</span> Jadi Lebih Praktis & Lezat.
                </h1>
                <p class="text-lg text-gray-600 mb-10 max-w-xl leading-relaxed">
                    Hubungkan kantor Anda dengan ratusan merchant katering terbaik. Atur pesanan harian atau mingguan
                    hanya dengan beberapa klik.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}"
                        class="px-8 py-4 bg-indigo-600 text-white text-center rounded-2xl font-bold text-lg hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200">Mulai
                        Berlangganan</a>
                    <a href="#cara-kerja"
                        class="px-8 py-4 bg-white text-indigo-600 text-center rounded-2xl font-bold text-lg border border-indigo-100 hover:bg-indigo-50 transition-all">Pelajari
                        Lebih Lanjut</a>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 blur-3xl opacity-20">
            <div class="w-[500px] h-[500px] bg-indigo-600 rounded-full"></div>
        </div>
    </header>

    <section class="bg-white py-12 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-900">500+</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1">Merchant</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-900">10k+</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1">Pesanan Harian</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-900">4.8/5</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1">Rating Kepuasan
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-900">24/7</div>
                    <div class="text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1">Bantuan CS</div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 KateringKita. Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
        </div>
    </footer>

</body>

</html>