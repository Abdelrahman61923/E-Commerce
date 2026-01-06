<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id', 'category_id', 'name', 'slug', 'short_description', 'description',
        'price', 'sale_price', 'SKU', 'stock_status', 'featured', 'quantity', 'image', 'images',
    ];
    protected $casts = [
        'images' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relations
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Global Scope
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }
}
