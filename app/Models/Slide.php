<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slide extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'tagline', 'title', 'subtitle', 'link', 'status'
    ];

    // Media Collection
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('image')
            ?: asset('assets/images/no_product.png');
    }
}
