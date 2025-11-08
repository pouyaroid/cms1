<?php

namespace App\Http\Controllers;

use App\Models\ContactNumber;
use Illuminate\Http\Request;

class ContactNumberController extends Controller
{
    public function index()
    {
        $contacts = ContactNumber::first();
        return view('layouts.partials.contact-us2', compact('contacts'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        ContactNumber::create($validatedData);

        return redirect()->back()->with('success', 'Contact saved successfully.');
    }
    public function updateOrCreate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        ContactNumber::updateOrCreate(
            ['id' => 1], 
            $validatedData
        );

        return redirect()->back()->with('success', 'Contact saved or updated successfully.');
    }
    public function create()
    {
        return view('admin.contact.create');
    }

}