<?php

namespace App\Relations;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasMachines {

    /**
     * Get the machine type.
     *
     * @return HasMany
     */
    public function machines(): HasMany
    {
        return $this->hasMany(Machine::class);
    }

    public function scopeWhereHasMachines($query) {
        return $query->whereHas('machines')->select(['id', 'name']);
    }

}
