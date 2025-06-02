<section id="about" class="bg-white dark:bg-slate-900 scroll-mt-[74px]">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight leading-none text-red-600 dark:text-red-700 md:text-4xl lg:text-5xl">Tentang Kami</h2>
            <p class="mt-4 text-xl text-muted-foreground">
                {{ config('app.name') }} adalah perusahaan layanan teknisi AC terpercaya yang telah beroperasi sejak tahun 2010. Dengan pengalaman lebih dari 15 tahun, kami melayani kebutuhan servis, perawatan rutin, hingga pemasangan sistem pendingin udara untuk rumah, kantor, dan tempat usaha. Komitmen kami adalah memberikan pelayanan terbaik yang cepat, profesional, dan tahan lama.
            </p>
        </div>
        <article class="grid mb-8 pt-8 text-left border-t border-slate-200 gap-8 dark:border-slate-700 lg:grid-cols-2">
            <div class="text-lg text-slate-700 dark:text-slate-600 text-justify space-y-4">
                <h2 class="text-red-600 dark:text-red-700 text-3xl font-bold">Cerita Kami</h2>
                <p class="text-muted-foreground">
                    Didirikan pada tahun 2010, {{ config('app.name') }} hadir dari kebutuhan masyarakat akan layanan perbaikan dan perawatan AC yang dapat diandalkan. Berawal dari tim kecil dengan keahlian teknis dan komitmen tinggi terhadap kepuasan pelanggan, kami mulai melayani rumah tangga dan usaha kecil di kawasan Jakarta Timur.
                </p>
                <p class="text-muted-foreground">
                    Seiring waktu, kepercayaan pelanggan terus bertambah. Dukungan mereka mendorong kami untuk berkembang — memperluas layanan ke berbagai wilayah sekitar dan memperkuat tim teknisi dengan pelatihan serta pengalaman lapangan selama lebih dari 15 tahun. Kini,
                    {{ config('app.name') }} dikenal sebagai mitra servis yang responsif, jujur, dan kompeten dalam menangani berbagai jenis AC, baik untuk kebutuhan rumah, kantor, maupun industri ringan.
                </p>
                <p class="text-muted-foreground">
                    Fokus kami tetap sama: memberikan layanan teknis berkualitas, harga yang wajar, dan hasil kerja yang tahan lama. Setiap servis yang kami lakukan bukan hanya sekadar memperbaiki mesin, tapi juga menjaga kenyamanan dan produktivitas lingkungan Anda.
                </p>
                <p class="text-muted-foreground">
                    Kami percaya, hubungan baik dengan pelanggan dimulai dari pelayanan yang tulus dan pekerjaan yang rapi. Karena itu, setiap panggilan servis adalah bagian dari cerita kami — dan kami ingin terus menuliskannya bersama Anda.
                </p>
            </div>
            <div class="relative h-[600px] overflow-hidden rounded-lg lg:h-full">
                <img src="{{ asset('/images/workshop-masa-lampau.png') }}" alt="Tentang Kami" class="absolute inset-0 object-cover h-full w-full" />
            </div>
        </article>
        <article class="grid place-items-center pt-8 text-left gap-8 lg:grid-cols-2">
            <div class="flex flex-wrap justify-center gap-4 h-fit order-last lg:order-first">
                @foreach($categories as $category)
                    <div class="w-full sm:w-64 lg:w-44 aspect-square flex-shrink-0 relative overflow-hidden transition-all duration-300 hover:shadow-md flex items-end rounded-lg">
                        <img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}" class="absolute inset-0 object-cover w-full h-full" />
                        <h3 class="relative font-medium text-sm text-center text-white bg-gradient-to-t via-red-950/50 from-red-950 to-transparent w-full pb-2 pt-8">{{ $category->name }}</h3>
                    </div>
                @endforeach
            </div>
            <div class="text-slate-700 dark:text-slate-600 space-y-4">
                <h2 class="text-red-600 dark:text-red-700 text-3xl font-bold">Alasan Memilih Kami</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-1 gap-0 md:gap-4 lg:gap-0">
                    <ul class="text-slate-500 list-inside dark:text-slate-400">
                        <li>
                            <div class="flex lg:text-xl font-medium">
                                <svg class="w-8 aspect-square me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Teknisi Berpengalaman & Profesional
                            </div>
                            <div class="border-l-2 border-slate-200 dark:border-slate-700 pl-4 ml-4">
                                <p class="text-justify text-slate-500 dark:text-slate-400 pb-2">
                                    Seluruh teknisi kami telah melewati pelatihan dan memiliki pengalaman bertahun-tahun dalam menangani berbagai jenis kerusakan AC. Kami menjunjung tinggi etika kerja, kerapian, dan komunikasi yang baik saat melayani pelanggan.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex lg:text-xl font-medium">
                                <svg class="w-8 aspect-square me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Layanan Cepat dan Tepat Waktu
                            </div>
                            <div class="border-l-2 border-slate-200 dark:border-slate-700 pl-4 ml-4">
                                <p class="text-justify text-slate-500 dark:text-slate-400 pb-2">
                                    Kami memahami pentingnya kenyamanan Anda. Oleh karena itu, kami berkomitmen memberikan layanan yang responsif, datang sesuai jadwal, dan menyelesaikan pekerjaan seefisien mungkin tanpa mengorbankan kualitas.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex lg:text-xl font-medium">
                                <svg class="w-8 aspect-square me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Harga Terjangkau & Transparan
                            </div>
                            <div class="border-l-2 border-slate-200 dark:border-slate-700 pl-4 ml-4">
                                <p class="text-justify text-slate-500 dark:text-slate-400 pb-2">
                                    Biaya servis kami disusun secara adil dan masuk akal. Tanpa biaya tersembunyi — Anda akan mengetahui estimasi harga sejak awal, lengkap dengan penjelasan layanan yang diberikan.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <ul class="text-slate-500 list-inside dark:text-slate-400">
                        <li>
                            <div class="flex lg:text-xl font-medium">
                                <svg class="w-8 aspect-square me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Garansi Servis Hingga 30 Hari
                            </div>
                            <div class="border-l-2 border-slate-200 dark:border-slate-700 pl-4 ml-4">
                                <p class="text-justify text-slate-500 dark:text-slate-400 pb-2">
                                    Untuk setiap layanan yang kami berikan, Anda mendapatkan garansi hingga 30 hari. Jika terjadi masalah yang sama dalam periode tersebut, kami siap datang kembali tanpa biaya tambahan.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex lg:text-xl font-medium">
                                <svg class="w-8 aspect-square me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Area Layanan Luas: Dalam & Luar Condet
                            </div>
                            <div class="border-l-2 border-slate-200 dark:border-slate-700 pl-4 ml-4">
                                <p class="text-justify text-slate-500 dark:text-slate-400 pb-2">
                                    Kami melayani wilayah Condet dan sekitarnya, termasuk area Jakarta Timur dan beberapa titik luar kota. Cukup hubungi kami dan kami akan menjangkau lokasi Anda dengan cepat.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('services.index') }}" class="col-span-full w-full sm:w-auto inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                Pesan sekarang
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </article>
    </div>
</section>
