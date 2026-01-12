<?php

namespace App\Models;

use App\Enums\ProductStockStatus;
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
        'stock_status' => ProductStockStatus::class,
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

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('assets/images/no_product.png');
        }
        return asset('storage/' . $this->image);
    }
    public function getImagesUrlsAttribute()
    {
        if (empty($this->images)) {
            if (!empty($this->image)) {
                return [];
            }
            return [asset('assets/images/no_product.png')];
        }
        return collect($this->images)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }
    public function getAllImagesAttribute()
    {
        $images = [];
        if ($this->image) {
            $images[] = $this->image_url;
        }
        foreach ($this->images_urls as $img) {
            $images[] = $img;
        }
        return $images;
    }
}
