<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $customers = Customer::all(); 
        return view('index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

   
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'logo_path' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:255',
        ]);

    
        Customer::create($validatedData);

     
        return redirect()->route('home')->with('success', 'مشتری با موفقیت ایجاد شد.');
    }

  
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

 
    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'logo_path' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:255',
        ]);

        
        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);

        
        return redirect()->route('home')->with('success', 'اطلاعات مشتری با موفقیت به‌روزرسانی شد.');
    }

    
    public function destroy($id)
    {
        
        $customer = Customer::findOrFail($id);
        $customer->delete();

       
        return redirect()->route('home')->with('success', 'مشتری با موفقیت حذف شد.');
    }
}