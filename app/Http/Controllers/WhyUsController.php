<?php

namespace App\Http\Controllers;

use App\Models\WhyUs;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    
    public function index()
    {
        $whyus = WhyUs::all();
        return view('layouts.mainpage.whyus', compact('whyus'));
    }

  
    public function create()
    {
        return view('admin.whyus.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        WhyUs::create($request->all());
        return redirect()->back()->with('success', 'آیتم با موفقیت اضافه شد.');
    }

    
    public function edit($id)
    {
        $item = WhyUs::findOrFail($id);
        return view('admin.whyus.edit', compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        $item = WhyUs::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($request->all());
        return redirect()->back()->with('success', 'آیتم با موفقیت ویرایش شد.');
    }


    public function destroy($id)
    {
        $item = WhyUs::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'آیتم حذف شد.');
    }
}
