<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tshirt extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tshirt_images';

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'tshirt_image_id', 'id');
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }

    protected function fullTshirtImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return asset('storage/tshirt_images/' . $this->image_url);
            },
        );
    }

    protected function fullTshirtSelfImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return asset('storage/tshirt_images_private/' . $this->image_url);
            },
        );
    }
}
