@if ($category)
    <ul class="prose prose-sm border-l pl-2">
        <li><img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}" class="my-0 mb-2" /></li>
        <li><x-filament::badge class="w-fit">{{ $category->name }}</x-filament::badge></li>
        <li>{!! $category->description !!}</li>
    </ul>
@else
    <span>-</span>
@endif
