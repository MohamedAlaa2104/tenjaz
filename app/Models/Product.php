<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'subscription_type_id',
        'name',
        'description',
        'image',
        'price',
        'slug',
        'is_active',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(SubscriptionType::class);
    }
}
