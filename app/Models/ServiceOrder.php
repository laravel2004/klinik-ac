<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceOrder extends Model
{
    use HasUlids;

    protected $fillable = [
        'user_id',
        'service_id',
        'start_time',
        'end_time',
        'phone',
        'address',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

	public function testimonial(): HasOne
	{
		return $this->hasOne(Testimonial::class);
	}
}
