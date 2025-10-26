<?php

namespace App\Http\Controllers;

use App\Models\ContactNumber;
use Illuminate\Http\Request;

class ContcatNumber extends Controller
{
    public function index(){
        $contacts=ContactNumber::first();
        return view('layouts.partials.contcact-us2','contacts');
    }
    public function Store(Request $request){
        $contact=$request->validate([
            'title'=>"required",
            'phone'=>"required",
        ]
            
        );
        ContactNumber::create($contact);
    }

    
}
