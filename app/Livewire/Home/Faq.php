<?php

namespace App\Livewire\Home;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Faq as FaqModel;

class Faq extends Component
{
    public Collection $faqs;

    public function mount(): void
    {
        $this->faqs = FaqModel::pluck('answer', 'question');
    }

    public function render(): View
    {
        return view('livewire.home.faq');
    }
}
