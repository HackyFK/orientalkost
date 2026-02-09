<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Cache::rememberForever("setting_{$key}", function () use ($key, $default) {
            return DB::table('settings')
                ->where('key', $key)
                ->value('value') ?? $default;
        });
    }
}
