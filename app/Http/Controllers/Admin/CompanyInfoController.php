<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function edit()
    {
 
        $info = CompanyInfo::firstOrCreate(['id' => 1]);
        return view('admin.company_info.edit', compact('info'));
    }

    public function update(Request $request)
    {
        $info = CompanyInfo::first();

        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'map_embed' => 'nullable|string',
            'copyright' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
           
            if ($info->logo && file_exists(storage_path('app/public/'.$info->logo))) {
                unlink(storage_path('app/public/'.$info->logo));
            }
            $data['logo'] = $request->file('logo')->store('company', 'public');
        }

        $info->update($data);

        return redirect()->back()->with('success', 'اطلاعات شرکت با موفقیت بروز شد');
    }
}
