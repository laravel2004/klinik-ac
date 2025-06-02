<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Service as ServiceModel;
use App\Models\ServiceOrder as ServiceOrderModel;

class OrderServiceForm extends Form
{
    public string $user_id = '';
    public string $service_id = '';
    public string $start_time = '';
    public string $end_time = '';
    public string $phone = '';
    public string $address = '';
    public string $notes = '';
    public string $date = '';

    protected function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required',
            'phone' => [
                'required',
                'regex:/^(?:\+62|0)8[1-9][0-9]{6,9}$/',
            ],
            'address' => 'required|min:3',
            'notes' => 'required|min:3',
            'date' => 'required|date|after_or_equal:today',
        ];
    }

    public function setOrder(ServiceModel $service): void
    {
        $this->user_id = auth()->id();
        $this->service_id = $service->id;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $date             = Carbon::parse($data['date']);
        $startTime        = $date->hour((int) $data['start_time']);
        $endTime          = $startTime->copy()->addHour();

        $dateTimeFormat = 'Y-m-d H:i:s';

        return array_merge($data, [
            'start_time' => $startTime->format($dateTimeFormat),
            'end_time'   => $endTime->format($dateTimeFormat),
        ]);
    }

    public function store(): string
    {
        $validated = $this->validate();

        $data = $this->mutateFormDataBeforeCreate($validated);

        $order = ServiceOrderModel::create($data);

        $this->reset();

        return $order->id;
    }
}
