<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Customer;
use App\Models\Faq;
use App\Models\HeroBanner;
use App\Models\Opinion;
use App\Models\Plan;
use App\Models\PortfolioItem;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\WhyUs;
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
        $teamMembers = TeamMember::latest()->get();
        $whyus = WhyUs::all();
        $faqs =Faq::all();
        $about = About::first();
        $settings = SiteSetting::firstOrNew([]);        

        return view('index',compact('customers','plans','hero','products','portfolios','opinions','teamMembers','whyus','faqs','about','settings'));
    }
}
