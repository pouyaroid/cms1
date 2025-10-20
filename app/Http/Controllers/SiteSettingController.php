<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'favicon' => 'nullable|image|mimes:png,ico,jpg,jpeg|max:2048',
        ]);

        $settings = SiteSetting::firstOrNew([]);

        if ($request->hasFile('favicon')) {
            $filename = time() . '.' . $request->favicon->extension();
            $request->favicon->move(public_path('uploads'), $filename);
            $settings->favicon = 'uploads/' . $filename;
        }

        $settings->fill($request->only(['title', 'publisher', 'meta_title', 'meta_description']));
        $settings->save();

        return back()->with('success', 'تنظیمات با موفقیت به‌روزرسانی شد');
    }
}
