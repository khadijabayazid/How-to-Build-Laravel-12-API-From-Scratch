<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache as FacadesCache;

class CategoryObserver
{
    public function created(Category $category): void
    {
        FacadesCache::forget('categories');
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
