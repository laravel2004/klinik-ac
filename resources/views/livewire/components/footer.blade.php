<footer class="p-4 bg-slate-700 md:p-8 lg:p-10 border-t border-red-500">
    <hr class="my-6 border-slate-200 sm:mx-auto dark:border-slate-700 lg:my-8" />
    <div class="flex flex-col sm:flex-row justify-between items-center max-w-screen-xl mx-auto px-4 gap-2">
        <a href="{{ route('home') }}" class="flex justify-center items-center text-2xl font-semibold text-slate-900 dark:text-white">
            <img src="{{ asset('/images/logo-teks-latar-transparan.png') }}" class="h-10" alt="Logo">
        </a>
        <span class="text-sm text-white sm:text-center">© 2025 <a href="{{ route('home') }}" class="hover:underline">{{ config('app.name') }}</a>. All Rights Reserved.</span>
    </div>
</footer>
