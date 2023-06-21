<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    public $timestamps = false; 

    use HasFactory;

    public function tshirt(): HasMany
    {
        return $this->hasMany(Tshirt::class,'category_id', 'id')->withTrashed();
    }

}
