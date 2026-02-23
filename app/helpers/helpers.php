<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return cache()->rememberForever(
            'setting_' . $key,
            function () use ($key, $default) {

                $value = Setting::where('key', $key)->value('value');

                if (!$value) {
                    return $default;
                }

                // decrypt untuk key sensitif
                if (in_array($key, [
                    'smtp_password',
                    'midtrans_server_key'
                ])) {
                    try {
                        return Crypt::decryptString($value);
                    } catch (\Exception $e) {
                        return $value;
                    }
                }

                return $value;
            }
        );
    }
}
