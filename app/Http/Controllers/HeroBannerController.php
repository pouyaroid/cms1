<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use Illuminate\Http\Request;

class HeroBannerController extends Controller
{
 
    public function index()
    {
        $hero = HeroBanner::first();
        return view('frontend.hero', compact('hero'));
    }

   
    public function adminIndex()
    {
        $hero = HeroBanner::first();
        return view('admin.hero.index', compact('hero'));
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
}
