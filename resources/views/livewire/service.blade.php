@php
    $orderId = session('order_id');
    $order = $orderId ? \App\Models\ServiceOrder::with(['user', 'service'])
        ->find($orderId) : null;

    $message = '';
    if ($orderId) {
        $id = strtoupper($order->id);
        $message = <<<TEXT
Halo Admin, saya ingin mengonfirmasi pesanan layanan AC dengan detail berikut:
- ID Pesanan: *{$id}*
- ID Layanan: *{$order->service->id}*
- Nama: *{$order->user->name}*
- Email: *{$order->user->email}*
- No. Telepon: *{$order->phone}*
Mohon tindak lanjutnya untuk proses selanjutnya. Terima kasih.
TEXT;
    }
@endphp

<main class="min-h-screen bg-white dark:bg-slate-900">
    <section id="service" class="grid place-items-center min-h-screen mt-[72px]">
        @if($message)
            <livewire:components.alerts.order-success-alert :$message />
        @endif
        <div class="py-8 px-4 mx-auto w-full max-w-screen-xl sm:py-16 lg:px-6">
            <livewire:components.breadcrumb :items="[
                ['label' => 'Layanan'],
            ]" />
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-red-600 dark:text-red-700">Layanan Praktis untuk Kesejukan Anda</h2>
                <p class="text-slate-500 sm:text-xl dark:text-slate-400">Dari cuci AC rutin sampai instalasi baru, semua layanan kami dirancang agar nyaman, cepat, dan tanpa ribet. Pesan teknisi sekarang, dan nikmati udara sejuk tanpa khawatir.</p>
            </div>
            <form class="mb-6 flex flex-col sm:flex-row justify-between gap-2">
                <div class="sm:max-w-md flex-1">
                    <label for="search" class="mb-2 text-sm font-medium text-slate-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center p-3 pointer-events-none">
                            <div class="bg-red-400 p-2 rounded-full">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                        </div>
                        <input type="search" id="search" wire:model.live.debounce.500ms="search" class="block w-full p-4 ps-14 text-sm text-slate-900 border border-slate-300 rounded-full bg-slate-50 focus:ring-red-500 focus:border-red-500 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 placeholder:text-slate-400 placeholder:font-medium" placeholder="Ketik untuk mencari..." required />
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @if($this->hasActiveFilters)
                        <button
                            wire:click="resetFilters"
                            wire:loading.attr="disabled"
                            wire:target="page, search, category, location, resetFilters"
                            type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm pl-2 pr-3 py-2 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 disabled:opacity-50"
                        >
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            Hapus Filter
                        </button>
                    @endif
                    <div class="flex-1">
                        <label for="category" class="mb-2 text-sm font-medium text-slate-900 dark:text-white sr-only">Category</label>
                        <select id="category" wire:model.live="category" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <ul class="p-1.5 mb-6 flex gap-1 w-fit text-sm font-medium text-center text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 shadow rounded-full mx-auto">
                @foreach([
                    '' => 'Semua',
                    '0' => 'Dalam',
                    '1' => 'Luar'
                ] as $value => $label)
                    @if($location === (string) $value)
                        <button type="button" class="inline-block px-6 py-3 text-white bg-red-600 rounded-full">
                            {{ $label }}
                        </button>
                    @else
                        <button type="button" wire:click="$set('location', '{{ $value }}')" class="inline-block px-6 py-3 hover:text-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 dark:hover:text-white rounded-full">
                            {{ $label }}
                        </button>
                    @endif
                @endforeach
            </ul>
            <div class="relative rounded-lg space-y-4 overflow-hidden md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:space-y-0">
                @forelse($services as $service)
                    <div class="w-full bg-white border border-slate-200 rounded-lg shadow-sm dark:bg-slate-800 dark:border-slate-700 hover:shadow-md transition">
                        <div class="relative h-64 w-full overflow-hidden">
                            <img class="absolute -top-16 object-cover transition-transform duration-300 hover:scale-105" src="{{ asset($service->thumbnail) }}" alt="{{ $service->name }}" />
                            <div class="absolute bottom-0 p-4 pt-8 w-full flex justify-between bg-gradient-to-t via-red-950/50 from-red-950 to-transparent">
                                <h3>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">{{ $service->serviceCategory->name }}</span>
                                </h3>
                                @if($service->is_outside_area->value)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Luar Area Condet</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('services.show', $service->slug) }}" class="text-xl font-semibold tracking-tight text-red-600 dark:text-red-700 hover:underline line-clamp-1">{{ $service->name }}</a>
                            <div class="mt-2.5 mb-5 line-clamp-2 min-h-[2.9rem]">
                                {!! $service->description !!}
                            </div>
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
                @empty
                    <div class="col-span-full py-8 px-4 lg:py-16 lg:px-6">
                        <div class="text-center">
                            <p class="mb-4 text-3xl tracking-tight font-bold text-slate-900 md:text-4xl dark:text-white">Layanan Tidak Ditemukan</p>
                            <p class="mb-4 text-lg font-light text-slate-500 dark:text-slate-400">Cari kembali dengan kata kunci lain. </p>
                        </div>
                    </div>
                @endforelse
                <div wire:loading wire:target="page, search, category, location">
                    <div class="absolute inset-0 grid place-items-center bg-slate-50/5 dark:bg-slate-800/5 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-red-600 animate-spin dark:text-slate-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m4.9 19.1 2.9-2.9"/><path d="M2 12h4"/><path d="m4.9 4.9 2.9 2.9"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="w-full mt-6">
                {{ $services->links() }}
            </div>
        </div>
    </section>
</main>
