<section id="faq" class="bg-white dark:bg-slate-900 scroll-mt-[74px]">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16">
        <h2 class="mb-8 text-3xl tracking-tight font-extrabold text-red-600 dark:text-red-700 md:text-4xl lg:text-5xl">Pertanyaan Umum (FAQ)</h2>
        <div class="grid pt-8 text-left border-t border-slate-200 md:gap-16 dark:border-slate-700 md:grid-cols-2 gap-8">
            <div class="space-y-8 lg:space-y-10">
                @foreach($faqs->take(ceil($faqs->count() / 2)) as $question => $answer)
                    <article>
                        <h3 class="flex mb-4 text-lg font-medium text-slate-900 dark:text-white">
                            <svg class="mt-1 flex-shrink-0 mr-2 w-5 h-5 text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                            {{ $question }}
                        </h3>
                        <div class="text-slate-500 dark:text-slate-400">
                            {!! $answer !!}
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="space-y-8 lg:space-y-10">
                @foreach($faqs->skip(ceil($faqs->count() / 2)) as $question => $answer)
                    <article>
                        <h3 class="flex mb-4 text-lg font-medium text-slate-900 dark:text-white">
                            <svg class="mt-1 flex-shrink-0 mr-2 w-5 h-5 text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                            {{ $question }}
                        </h3>
                        <div class="text-slate-500 dark:text-slate-400">
                            {!! $answer !!}
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
