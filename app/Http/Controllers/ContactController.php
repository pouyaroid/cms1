<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        return view('contact');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'comment' => 'required|string|max:200',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'پیام شما با موفقیت ارسال شد!');
    }
}
