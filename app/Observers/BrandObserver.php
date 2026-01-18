<?php

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandObserver
{
    /**
     * Handle the Brand "creating" event.
     */
    public function creating(Brand $brand): void
    {
        $brand->slug = Str::slug($brand->name);
    }
    /**
     * Handle the Brand "created" event.
     */
    public function created(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "updating" event.
     */
    public function updating(Brand $brand): void
    {
        $brand->slug = Str::slug($brand->name);
    }
    /**
     * Handle the Brand "updated" event.
     */
    public function updated(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "deleted" event.
     */
    public function deleted(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "restored" event.
     */
    public function restored(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     */
    public function forceDeleted(Brand $brand): void
    {
        //
    }
}
