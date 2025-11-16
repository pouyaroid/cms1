<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    // public function index()
    // {
    //     $customers = Customer::all(); 
    //     return view('index', compact('customers'));
    // }
    
    public function adminIndex()
    {
        $customers = Customer::all(); 
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

   
    public function store(Request $request)
{
    // فقط لوگوی آپلود شده اعتبارسنجی می‌شود
    $validatedData = $request->validate([
        'name' => 'nullable|string|max:255',
        'logo_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // فیلد آپلود
        'website_url' => 'nullable|url|max:255',
    ]);

    // ذخیره فایل آپلود شده و جایگذاری مسیر در logo_path
    if ($request->hasFile('logo_file')) {
        $validatedData['logo_path'] = $request->file('logo_file')->store('customers', 'public');
    }

    // حذف logo_file از آرایه validatedData چون ست نمی‌شود در مدل
    unset($validatedData['logo_file']);

    Customer::create($validatedData);

    return redirect()->route('admin.customers.index')->with('success', 'مشتری با موفقیت ایجاد شد.');
}
  
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
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

        
        return redirect()->route('admin.customers.index')->with('success', 'مشتری با موفقیت بروز شد.');

    }

    
    public function destroy($id)
    {
        
        $customer = Customer::findOrFail($id);
        $customer->delete();

       
        return redirect()->route('admin.customers.index')->with('success', 'مشتری با موفقیت حذف شد.');

    }
}