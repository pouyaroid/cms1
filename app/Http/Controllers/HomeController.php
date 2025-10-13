<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Plan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $customers = Customer::all(); 
        $plans=Plan::all();
        return view('index',compact('customers','plans'));
    }
}
