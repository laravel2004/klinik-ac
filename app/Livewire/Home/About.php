<?php

namespace App\Livewire\Home;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\ServiceCategory as CategoryModel;

class About extends Component
{
    public Collection $categories;

    public function mount(): void
    {
        $this->categories = CategoryModel::select(['thumbnail', 'name'])
            ->get();
    }

    public function render(): View
    {
        return view('livewire.home.about');
    }
}
