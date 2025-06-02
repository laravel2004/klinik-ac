<?php

namespace App\Livewire\Components\Forms;

use App\Services\ReservationService;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Service as ServiceModel;
use App\Livewire\Forms\OrderServiceForm as Form;

class OrderServiceForm extends Component
{
    public ServiceModel $service;
    public Form $form;

    public function mount(ServiceModel $service): void
    {
        $this->form->setOrder($service);
        $this->service = $service;
    }

    public function save(): void
    {
        $orderId = $this->form->store();

        session()->flash('order_id', $orderId);

        $this->redirectRoute('services.index');
    }

    #[Computed()]
    public function availableTimes(): array
    {
        if ($this->form->date) {
            return (new ReservationService())->getAvailableTimesForDate($this->form->date);
        }

        return [];
    }

    public function render(): View
    {
        return view('livewire.components.forms.order-service-form');
    }
}
