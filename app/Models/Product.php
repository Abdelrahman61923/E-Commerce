<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Enums\ProductStockStatus;
use Spatie\MediaLibrary\HasMedia;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'brand_id', 'category_id', 'name', 'slug', 'short_description', 'description',
        'price', 'sale_price', 'SKU', 'stock_status', 'featured', 'quantity',
    ];
    protected $casts = [
        'stock_status' => ProductStockStatus::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Media Collection
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile();
        $this->addMediaCollection('gallery');
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
        Product::observe(ProductObserver::class);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('main_image')
            ?: asset('assets/images/no_product.png');
    }

    public function getImagesUrlsAttribute()
    {
        $images = $this->getMedia('gallery');
        if ($images->isEmpty()) {
            return [];
        }
        return $images->map(function ($media) {
            return $media->getUrl();
        })->toArray();
    }

    public function getAllImagesAttribute()
    {
        $images = [];
        if ($this->getFirstMediaUrl('main_image')) {
            $images[] = $this->image_url;
        }
        foreach ($this->images_urls as $img) {
            $images[] = $img;
        }
        if (empty($images)) {
            return [asset('assets/images/no_product.png')];
        }

        return $images;
    }

    public function isLowStock()
    {
        $threshold = 5;
        return $this->quantity <= $threshold && $this->quantity > 0;
    }

    public function isOutOfStock()
    {
        return $this->stock_status == ProductStockStatus::OUTOFSTOCK;
    }
}
