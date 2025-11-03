<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuilderController extends Controller
{
    // نمایش ادیتور
    public function index()
    {
        return view('builder.index');
    }

    // ذخیره محتوای طراحی‌شده
    public function save(Request $request)
    {
        $html = $request->input('html');

        // اینجا می‌تونی ذخیره در دیتابیس یا فایل انجام بدی
        // فعلاً فقط نمایش می‌دیم
        return view('builder.preview', compact('html'));
    }
}
