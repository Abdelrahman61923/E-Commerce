<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'comment', 'status'
    ];

    protected $casts = [
        'status' => ContactStatus::class,
    ];
}
