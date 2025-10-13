<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::latest()->get();
        return view('admin.social_links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social_links.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'url'  => 'required|url',
        'icon' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->only(['name', 'url', 'icon', 'is_active']);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('social_links', 'public');
        $data['image'] = $path;
    }

    SocialLink::create($data);

    return redirect()->route('social-links.index')->with('success', 'شبکه اجتماعی با موفقیت اضافه شد');
}


public function update(Request $request, SocialLink $socialLink)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'url'  => 'required|url',
        'icon' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->only(['name', 'url', 'icon', 'is_active']);

    if ($request->hasFile('image')) {
        // حذف عکس قدیمی در صورت وجود
        if ($socialLink->image && file_exists(storage_path('app/public/' . $socialLink->image))) {
            unlink(storage_path('app/public/' . $socialLink->image));
        }

        $path = $request->file('image')->store('social_links', 'public');
        $data['image'] = $path;
    }

    $socialLink->update($data);

    return redirect()->route('social-links.index')->with('success', 'بروزرسانی با موفقیت انجام شد');
}
}
