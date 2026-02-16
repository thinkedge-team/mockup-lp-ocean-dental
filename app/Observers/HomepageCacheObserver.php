<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

/**
 * Observer to clear homepage cache when content is updated
 * This ensures the homepage shows fresh content after CMS updates
 */
class HomepageCacheObserver
{
    /**
     * Handle the model "saved" event (fires on create and update)
     */
    public function saved($model): void
    {
        $this->clearHomepageCache();
    }

    /**
     * Handle the model "deleted" event
     */
    public function deleted($model): void
    {
        $this->clearHomepageCache();
    }

    /**
     * Clear all homepage-related cache keys
     */
    protected function clearHomepageCache(): void
    {
        $cacheKeys = [
            'homepage.events',
            'homepage.services',
            'homepage.testimonials',
            'homepage.team_members',
            'homepage.locations',
            'homepage.gallery',
            'homepage.faqs',
            'homepage.results',
            'homepage.socmed_platforms',
            'homepage.regions_with_locations',
            // Also clear settings cache since many content changes might affect displayed settings
            'all_settings',
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
