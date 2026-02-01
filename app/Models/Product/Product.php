<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use App\Models\Images\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'price',
        'discount_price',
        'descriptions',
        'status',
    ];

     public function scopeSearch($query, $term)
    {
        return $query->where('title', 'LIKE', "%{$term}%")
                    ->orWhere('descriptions', 'LIKE', "%{$term}%");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }
}
