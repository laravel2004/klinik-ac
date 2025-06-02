<?php

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;

trait HasRole
{
    public function scopeHasRole(Builder $query, string $role): Builder
    {
        return $query->where('role', $role);
    }

    public function withRoleAccess(Builder $query): Builder
    {
        if ($this->role->value === UserRole::CUSTOMER->value) {
            $query->where('user_id', $this->id);
        }

        return $query;
    }
}
