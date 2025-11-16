<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
   
    public function index()
    {
        $portfolios = PortfolioItem::latest()->paginate(10);
        return view('layouts.mainpage.portfolio', compact('portfolios'));
    }

    
    public function create()
    {
        return view('admin.portfolio.create');
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

       
        $imagePath = $request->file('image')->store('portfolio', 'public');

      
        PortfolioItem::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'link' => $validated['link'] ?? null,
            'image' => $imagePath,
        ]);

        return redirect()->route('portfolio.index')->with('success', 'نمونه‌کار با موفقیت افزوده شد.');
    }

  
    public function edit(PortfolioItem $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

   
    public function update(Request $request, PortfolioItem $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:web,mobile,app',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

     
        if ($request->hasFile('image')) {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $validated['image'] = $request->file('image')->store('portfolio', 'public');
        }

        $portfolio->update($validated);

        return redirect()->route('portfolio.index')->with('success', 'نمونه‌کار با موفقیت ویرایش شد.');
    }

   
    public function destroy(PortfolioItem $portfolio)
    {
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'نمونه‌کار حذف شد.');
    }
}
