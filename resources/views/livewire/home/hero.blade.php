<section id="home" class="min-h-screen mb-8 sm:mb-16 bg-slate-950/60 bg-blend-multiply">
    <img src="{{ asset('/images/toko-tampak-depan.png') }}" alt="Home" class="absolute inset-0 object-cover object-left-top w-full h-full z-[-1]">
    <div class="grid place-items-center min-h-screen">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-32">
            <div class="mb-4 space-y-2">
                <h1 class="text-4xl font-extrabold tracking-tight leading-none text-red-600 dark:text-red-700 md:text-5xl lg:text-6xl">
                    {{ config('app.name') }}
                </h1>
                <h3 class="text-xl font-extrabold tracking-tight leading-none text-white md:text-2xl lg:text-3xl">Solusi Servis AC Terpercaya di Area Dalam & Luar Condet</h3>
            </div>
            <p class="mb-8 text-lg font-normal text-slate-300 lg:text-xl sm:px-16 lg:px-48">Lebih dari 15 tahun melayani pelanggan perorangan dan bisnis di Jakarta Timur & sekitarnya dengan solusi teknis AC yang cepat, tepat, dan bergaransi.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{ route('services.index') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                    Lihat layanan
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
                <a href="#about" class="inline-flex justify-center hover:text-slate-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-slate-100 focus:ring-4 focus:ring-slate-400">
                    Pelajari lebih lanjut
                </a>
            </div>
        </div>
    </div>
</section>
