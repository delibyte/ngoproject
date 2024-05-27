<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
