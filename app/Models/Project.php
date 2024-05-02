<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(Area::class);
    }

    public function donationtypes(): belongsToMany
    {
        return $this->belongsToMany(DonationType::class);
    }
}
