<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Service as ServiceModel;

class OrderService extends Component
{
    public ServiceModel $service;

    public function mount(string $slug): void
    {
        $this->service = tap(
            ServiceModel::with(['serviceCategory', 'serviceUnit'])
                ->where('slug', $slug)
                ->select([
                    'id',
                    'service_category_id',
                    'service_unit_id',
                    'name',
                    'slug',
                    'price',
                    'is_outside_area',
                ])
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
        return view('livewire.order-service')
            ->title('Pesan ' . $this->service->name);
    }
}
