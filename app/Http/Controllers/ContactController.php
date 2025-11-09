<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
{
    $q = $request->get('q');

    $messages = ContactMessage::when($q, function($query, $q) {
            $query->where('fullname', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('comment', 'like', "%{$q}%");
        })
        ->latest()
        ->paginate(15)
        ->withQueryString();

    return view('admin.contact_messages', compact('messages', 'q'));
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
    public function destroy(ContactMessage $contactMessage)
{
    $contactMessage->delete();
    return back()->with('success', 'پیام حذف شد.');
}
}
