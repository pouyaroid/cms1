<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
 
    public function index()
    {
        $plans = Plan::all();
        return view('pricing.index', compact('plans'));
    }


    public function create()
    {
        return view('pricing.create');
    }

 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'is_popular' => 'boolean',
            'features' => 'nullable|array',
        ]);

        
        if (isset($validated['features'])) {
            $validated['features'] = json_encode($validated['features']);
        }

        Plan::create($validated);

        return redirect()->route('plans.index')->with('success', 'تعرفه جدید با موفقیت ثبت شد.');
    }
}
