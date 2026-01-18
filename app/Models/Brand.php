<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\BrandObserver;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name', 'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Media Collection
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    // Relations
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Global Scope
    protected static function booted()
    {
        Brand::observe(BrandObserver::class);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('logo')
            ?: asset('assets/images/no_product.png');
    }
}
