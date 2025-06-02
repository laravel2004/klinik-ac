<?php

namespace App\Models;

use App\Enums\ServiceLocationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'service_unit_id',
        'thumbnail',
        'name',
        'slug',
        'price',
        'is_outside_area',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'is_outside_area' => ServiceLocationType::class,
        ];
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function serviceUnit(): BelongsTo
    {
        return $this->belongsTo(ServiceUnit::class);
    }

    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }
}
