<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Wishlist extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'user_id', 'cookie_id', 'product_id'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Global Scope
    public static function booted()
    {
        static::creating(function(Wishlist $wishlist) {
            $wishlist->id = Str::uuid();
        });
        static::addGlobalScope('wishlist_owner', function(Builder $builder) {
            $builder->where('cookie_id', '=', self::getCookieId());
        });
    }

    public static function getCookieId()
    {
        $cookie_id = Cookie::get('wishlist_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('wishlist_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }
}

