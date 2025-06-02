<div class="flex flex-col lg:flex-row gap-4">
    <div class="w-full h-fit lg:max-w-md p-4 bg-white border border-slate-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-slate-800 dark:border-slate-700">
        <h5 class="mb-8 text-xl font-medium text-slate-900 dark:text-white">Ringkasan Layanan</h5>
        <div class="flex items-start justify-between self-end">
            <div class="w-full grid gap-4 gird-col">
                <div class="flex items-center gap-2">
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">{{ $service->serviceCategory->name }}</span>
                    @if($service->is_outside_area->value)
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Luar Area Condet</span>
                    @endif
                </div>
                <h1 class="text-2xl font-semibold tracking-tight text-red-600 dark:text-red-700">{{ $service->name }}</h1>
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                            <span class="text-xl font-bold text-slate-900 dark:text-white">
                                {{ $service->formatted_price }}
                            </span>
                        <span class="text-sm">/ {{ $service->serviceUnit->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form wire:submit="save" id="order-service-form" class="relative flex-1 p-4 bg-white border border-slate-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-slate-800 dark:border-slate-700 overflow-hidden">
        <h5 class="mb-8 text-xl font-medium text-slate-900 dark:text-white">Buat Reservasi</h5>
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="w-full">
                <label for="date" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Tanggal<span class="ml-0.5 text-red-700">*</span></label>
                <div>
                    <input
                        wire:model.live="form.date"
                        id="date"
                        type="date"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        min="{{ now()->format('Y-m-d') }}"
                        required
                    />
                </div>
                @error('form.date')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">Hari Minggu libur.</p>
            </div>
            <div class="w-full">
                <label for="start_time" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Jam<span class="ml-0.5 text-red-700">*</span></label>
                <select
                    wire:model="form.start_time"
                    id="start_time"
                    class="border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                    required
                    @if(!$form->date)
                        disabled
                    @endif
                >
                    <option value="">Pilih Jam</option>
                    @foreach ($this->availableTimes as $key => $time)
                        <option value="{{ $key }}">{{ $time }}</option>
                    @endforeach
                </select>
                @error('form.start_time')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">Pilih jam yang tersedia.</p>
            </div>
            <div class="sm:col-span-2">
                <label for="phone" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Nomor telepon<span class="ml-0.5 text-red-700">*</span></label>
                <input
                    wire:model="form.phone"
                    id="phone"
                    type="tel"
                    class="border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                    required
                />
                @error('form.phone')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">Nomor yang dapat dihubungi.</p>
            </div>
            <div class="sm:col-span-2">
                <label for="address" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Alamat<span class="ml-0.5 text-red-700">*</span></label>
                <textarea
                    wire:model="form.address"
                    id="address"
                    rows="5"
                    class="block p-2.5 w-full text-sm text-slate-900 rounded-lg border border-slate-300 focus:ring-red-500 focus:border-red-500 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                    placeholder="Tulis alamat lengkap..."
                    required
                ></textarea>
                @error('form.address')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">Alamat lengkap yang akan dikunjungi.</p>
            </div>
            <div class="sm:col-span-2">
                <label for="notes" class="block mb-2 text-sm font-medium text-slate-900 dark:text-white">Catatan<span class="ml-0.5 text-red-700">*</span></label>
                <textarea
                    wire:model="form.notes"
                    id="notes"
                    rows="5"
                    class="block p-2.5 w-full text-sm text-slate-900 rounded-lg border border-slate-300 focus:ring-red-500 focus:border-red-500 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                    placeholder="Tulis catatan..."
                    required
                ></textarea>
                @error('form.notes')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">Catatan tambahan agar kebutuhan lebih tersampaikan.</p>
            </div>
        </div>
        <button
            type="button"
            data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800"
        >
            Simpan
        </button>
        <div wire:loading>
            <div class="absolute inset-0 grid place-items-center bg-white-50/5 dark:bg-slate-800/5 backdrop-blur-sm">
                <svg class="w-8 h-8 text-red-600 animate-spin dark:text-slate-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m4.9 19.1 2.9-2.9"/><path d="M2 12h4"/><path d="m4.9 4.9 2.9 2.9"/></svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </form>

    {{-- Popup Modal --}}
    <div id="create-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 min-h-screen max-h-full bg-slate-950/5 backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-slate-700">
                <button type="button" class="absolute top-3 end-2.5 text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-slate-600 dark:hover:text-white" data-modal-hide="create-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="size-20 mx-auto mb-4 text-yellow-400 dark:text-yellow-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-slate-500 dark:text-slate-400 grid">
                        <span>Pastikan semua data sudah benar.</span>
                        <span>Apakah Anda yakin ingin membuat pesanan?</span>
                    </h3>
                    <button data-modal-hide="create-modal" type="submit" form="order-service-form" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Simpan
                    </button>
                    <button data-modal-hide="create-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-slate-900 focus:outline-none bg-white rounded-lg border border-slate-200 hover:bg-slate-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-slate-100 dark:focus:ring-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-600 dark:hover:text-white dark:hover:bg-slate-700">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
