<?php

namespace App\Relations;
use App\Models\Property;

trait HasProperties {
    /**
     * Get all of the properties for the content.
     */
    public function properties()
    {
        return $this->morphToMany(Property::class, 'propertiables');
    }
}
