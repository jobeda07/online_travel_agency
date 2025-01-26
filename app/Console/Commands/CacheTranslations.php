<?php

namespace App\Console\Commands;

use App\Models\TranslateData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:cache-translations';
    protected $signature = 'cache:translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::remember('translations', now()->addDay(), function () {
            return TranslateData::all()->groupBy('lang_code')->map(function ($group) {
                return $group->keyBy('key');
            });
        });

        $this->info('Translations have been cached successfully.');
    }
}
