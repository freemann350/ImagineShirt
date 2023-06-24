<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    public $timestamps = false;

    public function order(): BelongsTo
    {
        return $this->BelongsTo(Order::class, 'order_id', 'id');
    }

    public function tshirt(): BelongsTo
    {
        return $this->BelongsTo(Tshirt::class, 'tshirt_image_id', 'id')->withTrashed();
    }
}
