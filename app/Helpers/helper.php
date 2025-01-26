<?php

use App\Models\Setting;
use App\Models\AccountLedger;
use App\Models\TranslateData;
use Illuminate\Support\Facades\Cache;




if (!function_exists('hellow_liza')) {
    function hellow_liza()
    {
        return 'hellow liza';
    }
}

if (!function_exists('get_setting')) {
    function get_setting($name)
    {
        return Setting::where('name', $name)->first();
    }
}

if (!function_exists('translate')) {
    function translate($key, $lang_code = null)
    {
        $defaultLang = 'en';
        $lang_code = $lang_code ?? session('selected_language', $defaultLang);

        $translations = Cache::get('translations', []);

        if (isset($translations[$lang_code][$key])) {
            return $translations[$lang_code][$key]->description;
        }

        if (isset($translations[$defaultLang][$key])) {
            return $translations[$defaultLang][$key]->description;
        }

        return $key;
    }
}

if (!function_exists('get_account_balance')) {
    function get_account_balance()
    {
        $ledger = AccountLedger::orderBy('id', 'DESC')->first();
        if($ledger){
            return $ledger->balance;
        }else{
            return 0.00;
        }
    }

    // if (!function_exists('getLangCode')) {
    //     function getLangCode()
    //     {
    //         $langCode = session('lang_code', 'en');
    //         Log::info('Current language code from helper function: ' . $langCode);
    //         return $langCode;
    //     }
    // }

    if (!function_exists('getLangCode')) {
        function getLangCode()
        {
            $userId = auth()->id() ?? request()->ip();
            return Cache::get("lang_code_{$userId}", 'en');
        }
    }
    
}
