<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.pages.settings.edit');
    }

    public function update(Request $request)
    {
        // Text fields සහ සමාජ මාධ්‍ය සබැඳි සියල්ලම මෙතැනට ඇතුළත් කර ඇත
        $inputs = $request->only([
            'site_name',
            'site_address',
            'site_phone',
            'site_email',
            'social_facebook',
            'social_instagram',
            'social_youtube',
            'social_tiktok'
        ]);

        foreach ($inputs as $key => $value) {
            Setting::set($key, $value);
        }

        // Logo Upload Logic එක (කලින් සකස් කළ පරිදි...)
        if ($request->hasFile('site_logo')) {
            $request->validate(['site_logo' => 'image|mimes:png,jpg,jpeg,webp|max:2048']);

            $oldLogo = Setting::get('site_logo');
            if ($oldLogo) {
                $oldLogoPath = public_path($oldLogo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $file = $request->file('site_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            Setting::set('site_logo', 'uploads/settings/' . $filename);
        }
        if ($request->hasFile('site_favicon')) {
            $request->validate([
                'site_favicon' => 'image|mimes:png,ico,jpg,jpeg|max:2048'
            ]);

            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon) {
                $oldFaviconPath = public_path($oldFavicon);
                if (file_exists($oldFaviconPath)) {
                    unlink($oldFaviconPath);
                }
            }

            $file = $request->file('site_favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            Setting::set('site_favicon', 'uploads/settings/' . $filename);
        }

        Cache::forget('site_settings');
        return back()->with('status', 'Settings updated successfully!');
    }
}
