<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class Breadcrumb extends Component
{
    public array $items = [];

    public function mount(array $items = []): void
    {
        $this->items = $items;
    }

    public function render(): View
    {
        return view('livewire.components.breadcrumb');
    }
}
