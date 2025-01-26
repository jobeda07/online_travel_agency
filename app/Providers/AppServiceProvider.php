<?php

namespace App\Providers;

use App\Models\TranslateData;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
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
        // if (Schema::hasTable('cache') && Schema::hasTable('translate_data')) {
        //     Cache::remember('translations', now()->addDay(), function () {
        //         return TranslateData::all()->groupBy('lang_code')->map(function ($group) {
        //             return $group->keyBy('key');
        //         });
        //     });
        // }
        Paginator::useBootstrap();
    }
}
