<main class="min-h-screen bg-white dark:bg-slate-900">
    <section id="view-service" class="grid min-h-screen mt-8 lg:mt-16">
        <div class="py-8 px-4 mx-auto w-full max-w-screen-xl sm:py-16 lg:px-6">
            <livewire:components.breadcrumb :items="[
                ['label' => 'Layanan', 'url' => route('services.index')],
                ['label' => 'Detail']
            ]" />
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-red-600 dark:text-red-700">Detail Layanan</h2>
                <h3 class="text-slate-500 sm:text-xl dark:text-slate-400">{{ $service->name }}</h3>
            </div>
            <article class="space-y-4 md:grid lg:grid-cols-2 md:gap-8 md:space-y-0">
                <div class="relative w-full lg:max-w-[600px] rounded-lg overflow-hidden border border-red-500">
                    <img
                        src="{{ asset($service->thumbnail) }}"
                        alt="{{ $service->name }}"
                        class="w-full object-cover aspect-video"
                    />
                </div>
                <div class="flex items-start justify-between self-end">
                    <div class="w-full grid gap-4 gird-col">
                        <div class="flex items-center gap-2">
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">{{ $service->serviceCategory->name }}</span>
                            @if($service->is_outside_area->value)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Luar Area Condet</span>
                            @endif
                        </div>
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-semibold tracking-tight text-red-600 dark:text-red-700">{{ $service->name }}</h1>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                            <span class="text-xl font-bold text-slate-900 dark:text-white">
                                {{ $service->formatted_price }}
                            </span>
                                <span class="text-sm">/ {{ $service->serviceUnit->name }}</span>
                            </div>
                            <a href="{{ route('services.order', $service->slug) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                                    <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                                </svg>
                                Pesan sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <hr class="h-px my-10 bg-slate-200 border-0 dark:bg-slate-700">
            <div>
                <h4 class="text-2xl font-bold mb-2">Deskripsi</h4>
                <div class="prose prose-lg">
                    {!! $service->description !!}
                </div>
            </div>
        </div>
    </section>
</main>
