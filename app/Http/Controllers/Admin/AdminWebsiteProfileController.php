<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWebsiteProfileController extends Controller
{
    public function index()
    {
        $profile = WebsiteProfile::first();

        return view('admin.website-profile.index', compact('profile'));
    }


    public function edit()
    {
        $profile = WebsiteProfile::first();

        return view('admin.website-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = WebsiteProfile::first();

        $data = $request->only([
            'description',
            'iframe_1',
            'iframe_2',
            'advantage_1_desc',
            'advantage_2_desc',
            'advantage_3_desc',

            'advantage_1_title',
            'advantage_1_icon',
            'advantage_2_title',
            'advantage_2_icon',
            'advantage_3_title',
            'advantage_3_icon',
            'latitude',
            'longitude',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($profile->image && Storage::exists('public/' . $profile->image)) {
                Storage::delete('public/' . $profile->image);
            }

            $path = $request->file('image')->store('website-profile', 'public');

            $data['image'] = $path;
        }

        $profile->update($data);

        return redirect()
            ->route('admin.website-profile.index')
            ->with('success', 'Profil Website berhasil diperbarui.');
    }
}
