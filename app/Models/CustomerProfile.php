<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Occupation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerProfile extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'gender',
        'birth_date',
        'phone',
        'occupation',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'gender' => Gender::class,
            'occupation' => Occupation::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
