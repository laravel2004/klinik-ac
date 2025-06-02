<div class="w-full max-w-screen-xl px-4 lg:px-6">
    <div x-data="{ copied: false, timeoutRef: null }" id="order-success-alert" class="p-4 mt-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-slate-800 dark:text-green-400 dark:border-green-800" role="alert">
        <div class="flex items-center">
            <svg class="shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Berhasil membuat pesanan</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            <p>Terima kasih telah memesan layanan kami.</p>
            <p>Untuk mempercepat proses penjadwalan, <b>DISARANKAN</b> agar Anda <b>mengonfirmasi pesanan</b> ke Admin melalui WhatsApp.</p>
            <p>Tekan tombol di bawah untuk menyalin pesan konfirmasi dan <a href="https://wa.me/6281906336996" target="_blank" class="text-blue-600 hover:underline">kirim pesan</a> sekarang.</p>
        </div>
        <div class="flex items-center">
            <span x-ref="copyText" class="sr-only">{{ $message }}</span>
            <button
                @click="
                            navigator.clipboard.writeText($refs.copyText.textContent)
                                .then(() => {
                                    copied = true;
                                    if (timeoutRef) clearTimeout(timeoutRef);
                                    timeoutRef = setTimeout(() => copied = false, 3000);
                                });
                        "
                type="button"
                class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            >
                <svg class="me-2 size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
                Salin pesan
            </button>
            <button type="button" class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-green-600 dark:border-green-600 dark:text-green-400 dark:hover:text-white dark:focus:ring-green-800" data-dismiss-target="#order-success-alert" aria-label="Close">
                Tutup
            </button>
            <p
                x-show="copied"
                x-transition
                class="flex items-center ml-2 text-sm text-green-600 dark:text-green-500"
            >
                <svg class="size-3 me-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                Disalin
            </p>
        </div>
    </div>
</div>
