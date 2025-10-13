<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers = NewsletterSubscriber::latest()->get();
        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function destroy(NewsletterSubscriber $newsletter)
    {
        $newsletter->delete();
        return back()->with('success', 'عضو خبرنامه حذف شد');
    }
}
