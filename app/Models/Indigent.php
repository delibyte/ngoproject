<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indigent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function family(): HasMany
    {
        return $this->hasMany(Indigent::class, 'parent_id');
    }

    public function aidType(): BelongsTo
    {
        return $this->belongsTo(DonationType::class, 'aid_type');
    }
}
