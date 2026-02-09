<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')
            ->orderBy('group')
            ->get()
            ->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            DB::table('settings')
                ->where('key', $key)
                ->update([
                    'value' => $value
                ]);

            Cache::forget("setting_{$key}");
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
