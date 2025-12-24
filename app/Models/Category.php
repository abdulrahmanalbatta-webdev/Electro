<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Trans;

    protected $guarded = [];

    function products()
    {
        return $this->hasMany(Product::class);
    }

    function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    function getImgPathAttribute()
    {
        return asset('images/' . $this->image->path ?? '');
    }
}
