<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\HeroBanner;
use App\Models\Opinion;
use App\Models\Plan;
use App\Models\PortfolioItem;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $customers = Customer::all(); 
        $plans=Plan::all();
        $hero = HeroBanner::first();
        $products=Product::all();
        $portfolios=PortfolioItem::all();
        $opinions = Opinion::latest()->take(6)->get();

        return view('index',compact('customers','plans','hero','products','portfolios','opinions'));
    }
}
