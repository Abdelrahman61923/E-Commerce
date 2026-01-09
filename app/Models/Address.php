<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name','phone','locality','address','city','state','country','landmark','zip','type',
        'user_id','is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
