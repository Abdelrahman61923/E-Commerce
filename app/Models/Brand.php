<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'image'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Global Scope
    protected static function booted()
    {
        static::creating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });
        static::updating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });
    }
}
