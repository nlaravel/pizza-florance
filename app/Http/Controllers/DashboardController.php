<?php

namespace App\Http\Controllers;

use App\Category;
use App\ContactUs;
use App\Entrees;
use App\Ingredient;
use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category=Category::where('parent_id',0)->count();
        $entrees=Entrees::count();
        $product=Product::where('is_special',1)->count();
        $ingredient=Ingredient::count();
        $messages=ContactUs::count();
        return view('dashboard.index',compact('category','entrees','product','ingredient','messages'));
    }
}
