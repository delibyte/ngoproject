<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class, 'region_id');
    }

    public function indigents(): HasMany
    {
        return $this->hasMany(Indigent::class, 'region_id');
    }

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class, 'region_id');
    }
}
