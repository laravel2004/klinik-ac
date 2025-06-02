<div
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => show = window.scrollY > 600)"
    x-show="show"
    x-transition
    class="fixed bottom-6 right-6 z-50"
>
    <button
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="bg-red-600 text-white p-3 rounded-full shadow-lg hover:bg-red-700 focus:outline-none"
        aria-label="Back to top"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 011.414 0L9 6.414V17a1 1 0 102 0V6.414l4.293 4.293a1 1 0 001.414-1.414l-6-6a1 1 0 00-1.414 0l-6 6a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
