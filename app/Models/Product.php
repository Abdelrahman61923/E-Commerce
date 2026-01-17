<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Enums\ProductStockStatus;
use Spatie\MediaLibrary\HasMedia;
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
        // static::addGlobalScope('stock_status', function (Builder $builder) {
        //     $builder->where('stock_status', ProductStockStatus::INSTOCK);
        // });
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
}
