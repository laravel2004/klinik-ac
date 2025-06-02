<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Service as ServiceModel;

class ViewService extends Component
{
    public ServiceModel $service;

    public function mount(string $slug): void
    {
        $this->service = tap(
            ServiceModel::with(['serviceCategory', 'serviceUnit'])
                ->where('slug', $slug)
                ->firstOrFail(),
            function ($service) {
                $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
                $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                $service->formatted_price = $formatter->formatCurrency($service->price, 'IDR');
            }
        );
    }

    public function render(): View
    {
        return view('livewire.view-service');
    }
}
