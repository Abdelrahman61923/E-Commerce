<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Media Collection
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    // Relations
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Global Scope
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('image')
            ?: asset('assets/images/no_product.png');
    }
}
