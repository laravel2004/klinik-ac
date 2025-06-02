<?php

namespace App\Livewire\Home;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Testimonial as TestimonialModel;

class Testimonial extends Component
{
    protected int $take = 2;
    protected int $total = 0;

    public function mount(): void
    {
        $this->total = TestimonialModel::count();
    }

    public function loadMore(): void
    {
        $this->take += 2;
    }

    #[Computed()]
    public function testimonials(): Collection
    {
        return TestimonialModel::with(['user:id,name'])
            ->select(['id', 'user_id', 'content'])
            ->take($this->take)
            ->get();
    }

    #[Computed()]
    public function showLoadMore(): bool
    {
        return $this->total % 2 === 0 && $this->take < $this->total;
    }

    public function render(): View
    {
        return view('livewire.home.testimonial');
    }
}
