<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class, 'region_id');
    }

    public function indigents(): HasMany
    {
        return $this->hasMany(Indigent::class, 'region_id');
    }
}
