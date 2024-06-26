<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function customer(): BelongsTo
    {
        return $this->BelongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'customer_id', 'id')->withTrashed();
    }

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }    
}