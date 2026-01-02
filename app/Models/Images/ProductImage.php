<?php

namespace App\Models\Images;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
