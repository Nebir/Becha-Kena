<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Product;
class HomeController extends Controller
{
    public function home()
    {
        $products = Product::take(6)->get();
        $categories = Category::take(6)->get();
        return view('home.index',[
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function about()
    {
        return view('home.about');
    }
}
