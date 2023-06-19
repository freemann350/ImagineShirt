<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tshirt extends Model
{
    use HasFactory;
    protected $table = 'tshirt_images';
    public $timestamps = false; 

    public function orderItem(): HasMany
    {
        return $this->hasMany(Tshirt::class, 'tshirt_image_id', 'id');
    }
}
