<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    // نمایش در سایت
    public function index()
    {
        $opinions = Opinion::latest()->take(6)->get(); // حداکثر ۶ تا برای نمایش
        return view('sections.opinion', compact('opinions'));
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

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        Opinion::create([
            'name' => $request->name,
            'role' => $request->role,
            'comment' => $request->comment,
            'avatar' => $avatarPath,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'نظر با موفقیت ثبت شد.');
    }
    public function update(Request $request, Opinion $opinion)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'role'    => 'nullable|string|max:255',
            'comment' => 'required|string',
            'avatar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date'    => 'nullable|date',
        ]);

       
        if ($request->hasFile('avatar')) {
            if ($opinion->avatar && Storage::disk('public')->exists($opinion->avatar)) {
                Storage::disk('public')->delete($opinion->avatar);
            }
            $opinion->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $opinion->update([
            'name'    => $request->name,
            'role'    => $request->role,
            'comment' => $request->comment,
            'avatar'  => $opinion->avatar,
            'date'    => $request->date,
        ]);

        return redirect()->back()->with('success', 'نظر با موفقیت به‌روزرسانی شد.');
    }

 
    public function destroy(Opinion $opinion)
    {
        if ($opinion->avatar && Storage::disk('public')->exists($opinion->avatar)) {
            Storage::disk('public')->delete($opinion->avatar);
        }

        $opinion->delete();

        return redirect()->back()->with('success', 'نظر با موفقیت حذف شد.');
    }
}
