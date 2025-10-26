<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // نمایش همه منوها
    public function index()
    {
        // دریافت منوهای اصلی با زیرمنوها
        $menus = Menu::whereNull('parent_id')->orderBy('order')->with('children')->get();
    
        // اگر دیتابیس خالی بود هم $menus یک collection خالی می‌شود
        return view('menu.index', compact('menus'));
    }
    
    // ذخیره منوی جدید
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'is_external' => 'nullable|boolean',
        ]);

        Menu::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0,
            'is_external' => $request->is_external ?? false,
        ]);

        return redirect()->route('menus.index')->with('success', 'منو با موفقیت ایجاد شد.');
    }

    // نمایش فرم ویرایش منو
    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('order')->get();
        return view('menu.edit', compact('menu', 'parents'));
    }

    // بروزرسانی منو
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'is_external' => 'nullable|boolean',
        ]);

        $menu->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0,
            'is_external' => $request->is_external ?? false,
        ]);

        return redirect()->route('menus.index')->with('success', 'منو با موفقیت بروزرسانی شد.');
    }

    // حذف منو
    public function destroy(Menu $menu)
    {
        // ابتدا زیرمنوها را حذف می‌کنیم
        $menu->children()->delete();
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'منو با موفقیت حذف شد.');
    }
    // نمایش فرم ایجاد منوی جدید
public function create()
{
    // فقط منوهای اصلی برای انتخاب والد (زیرمنو) را می‌گیریم
    $parents = Menu::whereNull('parent_id')->orderBy('order')->get();
    return view('menu.create', compact('parents'));
}

}
