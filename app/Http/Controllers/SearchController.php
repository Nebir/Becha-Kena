<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function productSearch(Request $request)
    {
        $productList = Product::where('name', 'like', '%'.$request->nameSearch.'%')->get();
        /*return $productList;*/
        return view('product.product_search_result', [
            'productList' => $productList
        ]);
    }

    public function index(Request $request)
    {

    }
}
