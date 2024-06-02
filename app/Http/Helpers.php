<?php

use App\Models\Setting;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

if (!function_exists('get_title')) {
    function get_title($key, $default = null)
    {

        $setting = Cache::remember('settings', 86400, function () {
            return Setting::first();
        });

        return $setting == null ? $default : $setting->$key;
    }
}
