<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpinionController extends Controller
{
    // نمایش در سایت
    public function index()
    {
        $opinions = Opinion::latest()->take(6)->get();
        return view('sections.opinion', compact('opinions'));
    }

    // مدیریت ادمین
    public function adminIndex()
    {
        $opinions = Opinion::latest()->get();
        return view('admin.opinions.index', compact('opinions'));
    }

    public function create()
    {
        return view('admin.opinions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'nullable|date',
        ]);

        $avatarPath = $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null;

        Opinion::create([
            'name' => $request->name,
            'role' => $request->role,
            'comment' => $request->comment,
            'avatar' => $avatarPath,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.opinions.index')->with('success', 'نظر با موفقیت ثبت شد.');
    }

    public function edit(Opinion $opinion)
    {
        return view('admin.opinions.edit', compact('opinion'));
    }

    public function update(Request $request, Opinion $opinion)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'nullable|date',
        ]);

        if ($request->hasFile('avatar')) {
            if ($opinion->avatar && Storage::disk('public')->exists($opinion->avatar)) {
                Storage::disk('public')->delete($opinion->avatar);
            }
            $opinion->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $opinion->update([
            'name' => $request->name,
            'role' => $request->role,
            'comment' => $request->comment,
            'avatar' => $opinion->avatar,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.opinions.index')->with('success', 'نظر با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Opinion $opinion)
    {
        if ($opinion->avatar && Storage::disk('public')->exists($opinion->avatar)) {
            Storage::disk('public')->delete($opinion->avatar);
        }
        $opinion->delete();

        return redirect()->route('admin.opinions.index')->with('success', 'نظر با موفقیت حذف شد.');
    }
}
