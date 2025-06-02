@php
    $totalTestimonial = \App\Models\Testimonial::where('is_publish', true)->count();
@endphp

<nav class="bg-white dark:bg-slate-900 fixed w-full z-20 top-0 start-0 border-b border-red-200 dark:border-red-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-end sm:justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="hidden sm:flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('/images/logo-teks-latar-transparan.png') }}" class="h-10" alt="Logo">
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if(!auth()->check())
                <div class="flex space-x-2">
                    <a href="{{ route('filament.customer.auth.login') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Login</a>
                    <a href="{{ route('filament.customer.auth.register') }}" class=" text-slate-900 focus:outline-none bg-white border border-slate-200 hover:bg-slate-100 hover:text-red-700 focus:z-10 focus:ring-slate-100 dark:focus:ring-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-600 dark:hover:text-white dark:hover:bg-slate-700 focus:ring-4 font-medium rounded-lg px-4 py-2 text-center">Daftar</a>
                </div>
            @else
                <a href="{{ auth()->user()?->role->value === 'admin' ? route('filament.admin.pages.dashboard') : route('filament.customer.pages.dashboard') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Dashboard</a>
            @endguest
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-slate-500 rounded-lg md:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:text-slate-400 dark:hover:bg-slate-700 dark:focus:ring-slate-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="navbar-sticky">
            <ul class="text-lg flex flex-col p-4 md:p-0 mt-4 font-medium border border-slate-100 rounded-lg bg-slate-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-slate-800 md:dark:bg-slate-900 dark:border-slate-700">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-3 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:text-white dark:hover:bg-slate-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-slate-700">Home</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#about" class="block py-2 px-3 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:text-white dark:hover:bg-slate-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-slate-700">Tentang Kami</a>
                </li>
                @if($totalTestimonial >= 2)
                    <li>
                        <a href="{{ route('home') }}#testimonial" class="block py-2 px-3 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:text-white dark:hover:bg-slate-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-slate-700">Testimoni</a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('services.index') }}" class="block py-2 px-3 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:text-white dark:hover:bg-slate-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-slate-700">Layanan</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#faq" class="block py-2 px-3 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:text-white dark:hover:bg-slate-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-slate-700">FAQ</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#contact" class="block py-2 px-3 text-slate-900 rounded hover:bg-slate-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:dark:hover:text-red-500 dark:text-white dark:hover:bg-slate-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-slate-700">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
