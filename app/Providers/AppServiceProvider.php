<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production (shared hosting behind reverse proxy)
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        // Register cache observers for homepage content models
        // This ensures the homepage cache is cleared when content is updated via CMS
        $observer = \App\Observers\HomepageCacheObserver::class;

        \App\Models\Event::observe($observer);
        \App\Models\Service::observe($observer);
        \App\Models\Testimonial::observe($observer);
        \App\Models\TeamMember::observe($observer);
        \App\Models\Location::observe($observer);
        \App\Models\Region::observe($observer);
        \App\Models\Gallery::observe($observer);
        \App\Models\Faq::observe($observer);
        \App\Models\Result::observe($observer);
        \App\Models\SocMedPlatform::observe($observer);
        \App\Models\Promo::observe($observer);
        \App\Models\Technology::observe($observer);
    }
}
