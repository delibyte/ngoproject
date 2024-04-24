<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipment extends Model
{
    use HasFactory;

    public function item(): HasOne
    {
        return $this->hasOne(Donation::class);
    }

    public function receiver(): HasOne
    {
        return $this->hasOne(User::class, 'receiver_id');
    }

    public function dispatcher(): HasOne
    {
        return $this->hasOne(User::class, 'dispatcher_id');
    }
}
