<?php

namespace App\Livewire\Components\Alerts;

use Illuminate\View\View;
use Livewire\Component;

class OrderSuccessAlert extends Component
{
    public string $message = '';

    public function mount(string $message): void
    {
        $this->message = $message;
    }
    public function render(): View
    {
        return view('livewire.components.alerts.order-success-alert');
    }
}
