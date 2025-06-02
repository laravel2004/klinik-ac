@php
    $totalTestimonial = \App\Models\Testimonial::where('is_publish', true)->count();
@endphp


<main>
    <script
        type="module"
        src="https://unpkg.com/@rasahq/chat-widget-ui/dist/rasa-chatwidget/rasa-chatwidget.esm.js"
    ></script>
    <link
        rel="stylesheet"
        href="https://unpkg.com/@rasahq/chat-widget-ui/dist/rasa-chatwidget/rasa-chatwidget.css"
    />
    <livewire:home.hero />
    <livewire:home.about />
    @if($totalTestimonial >= 2)
        <livewire:home.testimonial />
    @endif
    <livewire:home.faq />
    <livewire:home.contact />
    <rasa-chatbot-widget server-url="http://localhost:5005"></rasa-chatbot-widget>
</main>
