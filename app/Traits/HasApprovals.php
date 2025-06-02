<?php

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;

trait HasApprovals
{
    public function scopeApprovals(Builder $query): Builder
    {
        $user = auth()->user();

        if ($user->role->value === UserRole::CUSTOMER->value) {
            return $query->where('user_id', $user->id);
        }

        return $query;
    }
}
