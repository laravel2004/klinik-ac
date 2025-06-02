<main class="min-h-screen bg-white dark:bg-slate-900">
    <section id="order-service" class="grid min-h-screen mt-8 lg:mt-16">
        <div class="py-8 px-4 mx-auto w-full max-w-screen-xl sm:py-16 lg:px-6">
            <livewire:components.breadcrumb :items="[
                ['label' => 'Layanan', 'url' => route('services.index')],
                ['label' => 'Detail', 'url' => route('services.show', $this->service->slug)],
                ['label' => 'Pesan']
            ]" />
            <div class="max-w-screen-md mb-8">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-red-600 dark:text-red-700">Pesan Layanan</h2>
            </div>
            <livewire:components.forms.order-service-form :$service />
        </div>
    </section>
</main>
