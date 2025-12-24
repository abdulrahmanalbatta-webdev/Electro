<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Trans, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'main');
    }

    function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery');
    }

    function reviews()
    {
        return $this->hasMany(Review::class)->withDefault();
    }

    function carts()
    {
        return $this->hasMany(Cart::class)->withDefault();
    }


    function order_items()
    {
        return $this->hasMany(OrderItems::class)->withDefault();
    }

    function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    function getImgPathAttribute()
    {
        return asset('images/' . $this->image->path);
    }
}
