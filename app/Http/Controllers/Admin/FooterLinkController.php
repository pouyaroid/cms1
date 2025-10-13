<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function index()
    {
        $links = FooterLink::orderBy('group')->orderBy('order')->get();
        return view('admin.footer_links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.footer_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        FooterLink::create($request->all());

        return redirect()->route('footer-links.index')->with('success', 'لینک با موفقیت اضافه شد');
    }

    public function edit(FooterLink $footerLink)
    {
        return view('admin.footer_links.edit', compact('footerLink'));
    }

    public function update(Request $request, FooterLink $footerLink)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $footerLink->update($request->all());

        return redirect()->route('footer-links.index')->with('success', 'بروزرسانی با موفقیت انجام شد');
    }

    public function destroy(FooterLink $footerLink)
    {
        $footerLink->delete();
        return back()->with('success', 'لینک حذف شد');
    }
}
