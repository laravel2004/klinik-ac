<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

class Hero extends Component
{
    public function render(): View
    {
        return view('livewire.home.hero');
    }
}
