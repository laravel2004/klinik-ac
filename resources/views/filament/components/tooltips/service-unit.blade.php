@if ($unit)
    <ul class="prose prose-sm border-l pl-2">
        <li><x-filament::badge class="w-fit">{{ $unit->name }}</x-filament::badge></li>
        <li>{!! $unit->description !!}</li>
    </ul>
@else
    <span>-</span>
@endif
