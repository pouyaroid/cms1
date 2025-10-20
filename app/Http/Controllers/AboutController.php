<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('about.index', compact('about'));
    }

    public function create()
    {
        return view('about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'background_shape' => 'nullable|image|max:2048',
            'val1' => 'nullable|integer',
            'val1_label' => 'nullable|string|max:255',
            'val2' => 'nullable|integer',
            'val2_label' => 'nullable|string|max:255',
            'val3' => 'nullable|integer',
            'val3_label' => 'nullable|string|max:255',
            'val4' => 'nullable|integer',
            'val4_label' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        if ($request->hasFile('background_shape')) {
            $data['background_shape'] = $request->file('background_shape')->store('about', 'public');
        }

        About::create($data);

        return redirect()->route('about.index')->with('success', 'اطلاعات با موفقیت ذخیره شد');
    }

    public function show(About $about)
    {
        return view('about.show', compact('about'));
    }

    public function edit(About $about)
    {
        return view('about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'background_shape' => 'nullable|image|max:2048',
            'val1' => 'nullable|integer',
            'val1_label' => 'nullable|string|max:255',
            'val2' => 'nullable|integer',
            'val2_label' => 'nullable|string|max:255',
            'val3' => 'nullable|integer',
            'val3_label' => 'nullable|string|max:255',
            'val4' => 'nullable|integer',
            'val4_label' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) Storage::disk('public')->delete($about->image);
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        if ($request->hasFile('background_shape')) {
            if ($about->background_shape) Storage::disk('public')->delete($about->background_shape);
            $data['background_shape'] = $request->file('background_shape')->store('about', 'public');
        }

        $about->update($data);

        return redirect()->route('about.index')->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد');
    }

    public function destroy(About $about)
    {
        if ($about->image) Storage::disk('public')->delete($about->image);
        if ($about->background_shape) Storage::disk('public')->delete($about->background_shape);
        $about->delete();

        return redirect()->route('about.index')->with('success', 'رکورد حذف شد');
    }
}
