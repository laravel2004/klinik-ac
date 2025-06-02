<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Service as ServiceModel;
use App\Models\ServiceCategory as ServiceCategoryModel;
use Livewire\WithPagination;

#[Title('Layanan')]
class Service extends Component
{
    use WithPagination;

    public Collection $categories;

    #[Url(except: '')]
    public string $search = '';

    #[Url(except: '')]
    public string $category = '';

    #[Url(except: '')]
    public string $location = '';

    #[Computed()]
    public function hasActiveFilters(): bool
    {
        return $this->search !== '' || $this->category !== '' || $this->location !== '';
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingLocation(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset('search', 'category', 'location');
    }

    public function render(): View
    {
        $this->categories = ServiceCategoryModel::select('name')->get();

        $services = ServiceModel::with(['serviceCategory', 'serviceUnit'])
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->when($this->location !== '', fn ($q) =>
                $q->where('is_outside_area', $this->location)
            )
            ->when($this->category, fn ($q) =>
                $q->whereHas('serviceCategory', fn ($q2) =>
                    $q2->where('name', $this->category)
            ))
            ->select([
                'id',
                'service_category_id',
                'service_unit_id',
                'thumbnail',
                'name',
                'slug',
                'price',
                'is_outside_area',
                'description'
            ])
            ->paginate(9)
            ->through(function ($service) {
                $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
                $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                $service->formatted_price = $formatter->formatCurrency($service->price, 'IDR');
                return $service;
        });

        return view('livewire.service', compact('services'));
    }
}
