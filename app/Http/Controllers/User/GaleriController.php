<?php

namespace App\Http\Controllers\User;

use App\Models\Galeri;
use App\Models\Setting;
use App\Http\Controllers\Controller;

class GaleriController extends Controller
{

public function index()
{
      $settingsRaw = Setting::all();

        $settings = new \stdClass();

        foreach ($settingsRaw as $item) {
            $settings->{$item->key} = $item->value;
        }
    $galeris = Galeri::latest()->get();

    return view('user.galeri.index', compact('galeris', 'settings'));
}
}
