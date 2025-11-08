<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use Illuminate\Http\Request;

class HeroBannerController extends Controller
{
 
    public function index()
    {
        $hero = HeroBanner::first();
        return view('layouts.mainpage.herobanner', compact('hero'));
    }

   
    public function adminIndex()
    {
        $heroes = HeroBanner::latest()->get();
        return view('admin.hero.index', compact('heroes'));
    }

   
    public function update(Request $request, $id)
    {
        $hero = HeroBanner::findOrFail($id);

        $data = $request->validate([
            'subtitle' => 'nullable|string',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'highlight_text' => 'nullable|string',
            'primary_button_text' => 'nullable|string',
            'primary_button_link' => 'nullable|string',
            'secondary_button_text' => 'nullable|string',
            'secondary_button_link' => 'nullable|string',
            'main_image' => 'nullable|image',
            'shape_image' => 'nullable|image',
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('hero', 'public');
        }

        if ($request->hasFile('shape_image')) {
            $data['shape_image'] = $request->file('shape_image')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'بنر با موفقیت ویرایش شد.');
    }
    public function create()
    {
        return view('admin.hero.create');
    }
    public function edit($id)
    {
        $hero = HeroBanner::findOrFail($id);
        return view('admin.hero.edit', compact('hero'));
    }
    public function destroy($id)
    {
        $hero = HeroBanner::findOrFail($id);
        $hero->delete();

        return redirect()->route('admin.hero.index')->with('success', 'بنر حذف شد.');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'subtitle' => 'nullable|string',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'highlight_text' => 'nullable|string',
            'primary_button_text' => 'nullable|string',
            'primary_button_link' => 'nullable|string',
            'secondary_button_text' => 'nullable|string',
            'secondary_button_link' => 'nullable|string',
            'main_image' => 'nullable|image',
            'shape_image' => 'nullable|image',
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('hero', 'public');
        }

        if ($request->hasFile('shape_image')) {
            $data['shape_image'] = $request->file('shape_image')->store('hero', 'public');
        }

        HeroBanner::create($data);

        return redirect()->route('admin.hero.index')->with('success', 'بنر جدید اضافه شد.');
    }

}
