<section id="testimonial" class="bg-white dark:bg-slate-900 scroll-mt-[74px]">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight leading-none text-red-600 dark:text-red-700 md:text-4xl lg:text-5xl">Testimoni</h2>
            <p class="mt-4 text-xl text-muted-foreground">
                Kepuasan Anda adalah prioritas utama kami. Simak bagaimana layanan kami telah membantu banyak pelanggan menjaga kenyamanan di rumah dan tempat usaha mereka.
            </p>
        </div>
        <article class="grid mb-8 pt-8 text-left border-t border-slate-200 gap-8 dark:border-slate-700 lg:grid-cols-2">
            @foreach($this->testimonials as $testimonial)
                <figure class="p-5 rounded bg-gray-100 dark:bg-gray-800">
                    <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
                    </svg>
                    <blockquote>
                        <div class="text-lg md:text-xl lg:text-2xl font-medium text-gray-900 dark:text-white text-center">
                            {!! $testimonial->content !!}
                        </div>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-6 h-6 rounded-full" src="https://i.pravatar.cc/300" alt="Avatar">
                        <div class="pr-3 font-medium text-gray-900 dark:text-white">{{ $testimonial->user->name }}</div>
                    </figcaption>
                </figure>
            @endforeach
        </article>
        @if($this->showLoadMore)
            <div class="flex flex-1 gap-4 justify-center items-center">
                <a href="{{ route('services.index') }}" class="inline-flex justify-center items-center py-2.5 px-5 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                    Pesan sekarang
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
                <button wire:click="loadMore" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Lihat lainnya...</button>
            </div>
        @endif
    </div>
</section>
