<?php

namespace App\Http\Controllers;

use App\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Product;
use App\Category;
use App\Tag;

class ProductsController extends Controller
{
    private $request;
    private $productsQuery;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->productsQuery = Product::query();

//        if(Auth::guest() || Auth::user()->isUser())
//            $this->productsQuery->public()->published();
    }


    public function index() {
        if(!$this->request->ajax()) {
            $products = $this->productsQuery->paginate(12);
            $data = [
                'navCategories' => Category::get(),
                'productTags' => Tag::get()
            ];

            return view('product.index',[
                'products' => $products,
            ], $data);
        }

        $this->_attachCategoryFilter();
        $this->_attachTagsFilter();
        $this->_attachSearchFilter();
        $this->_attachPriceFilter();
        //$this->_attachChoiceFilter();

        $products = $this->productsQuery->paginate(12);
        return response()->json([
            'products' => $products,
            'view' => view('product.filter_product')->with('products', $products)->render()
        ])->header('Vary', 'Accept');
    }


    private function _attachCategoryFilter() {
        try {
            $categoryName = $this->request->input('category');

            //Log::info($categoryName);

            if($categoryName == 'all') return;

            $categoryId = Category::where('name', '=', $categoryName)->first(['id'])->id;
            //Log::info($categoryId);
            $this->productsQuery->where('category_id', '=', $categoryId);
        } catch (Exception $e) {

        }
    }

    private function _attachTagsFilter() {
        try {
            $tags = $this->request->input('tags');

            $tagIds = Tag::whereIn('name', $tags)->pluck('id');
            Log::info(json_encode($tagIds));
            $this->productsQuery->whereHas('tags', function($q) use($tagIds) {
                $q->whereIn('tags.id', $tagIds);
            });
        } catch (Exception $e) {

        }
    }

    private function _attachSearchFilter() {
        try {
            $q = $this->request->input('search');

            if(empty($q)) return;

            $this->productsQuery->where(function ($query) use($q) {
                $query->where('title', 'LIKE', "%$q%")
                    ->orWhere('subtitle', 'LIKE', "%$q%")
                    ->orWhere('slug', 'LIKE', "%$q%")
                    ->orWhere('price_type', 'LIKE', "%$q%")
                    ->orWhere('supported_browsers', 'LIKE', "%$q%")
                    ->orWhere('technology_used', 'LIKE', "%$q%");
            });

        } catch (Exception $e) {

        }
    }

    private function _attachPriceFilter() {
        try {
            $price = $this->request->input('price');
            $price = 0;
            $this->productsQuery->where('unit_price' ,'>', $price);

        } catch (Exception $e) {

        }
    }

    private function _attachChoiceFilter() {
        try {
            $choiceType = $this->request->input('choice');

            // TODO: define popular
            if($choiceType == 'popular')
                $this->productsQuery->orderBy('id', 'asc');
            else if($choiceType == 'latest')
                $this->productsQuery->orderBy('id', 'desc');
            else if($choiceType == 'most_downloaded')
                $this->productsQuery->orderBy('download_count', 'desc');

        } catch (Exception $e) {

        }
    }

    public function singleProduct($productId) {
        $authUser = Auth::user();
        $product = Product::with(['category', 'tags','productOwner'])->find($productId);

        return view('product.SingleProduct',[
            'product' => $product,
            'authUser'=> $authUser
        ]);
    }

    public function productCreate()
    {
        $authUser = Auth::user()->id;
        $categories = Category::get();
        $tags = Tag::get();
        return view('product.create', [
            'categories' => $categories,
            'tags'       => $tags
        ]);
    }

    public function store(Request $request) {
        $authUser = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'available_quantity' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails())
        {
            dd($validator->getMessageBag());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request -> image)
            $image = $this->uploadFile($request->file('image'), '/../images/products/');
        else
            $image = '/images/products/product_default.png';
        //Nothing in the post model
        $product = new Product();
        $product->name = $request->name;
        $product->image = $image;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->available_quantity = $request->available_quantity;
        $product->category_id = $request->category_id;
        $product->owner_id = $authUser;
        $product->status = false;
        $product->save();
        $product->tags()->attach($request->input('product_tag'));

        return redirect('profile')->with('success', 'A new product is successfully created!');
    }

    public function edit($id) {
        $product = Product::with('tags')->findOrFail($id);
        $categories = Category::get();
        $tags = Tag::get();
        //$authUser = Auth::user();
        return view('product.edit',[
            'product' => $product,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->available_quantity = $request->available_quantity;
        $product->category_id = $request->category_id;
        $product->save();
        $product->tags()->sync($request->input('product_tag'));
        return redirect('profile')->with('success', 'Your Product is successfully updated!');
    }

    public function destroy($id)
    {
        $productDelete = Product::find($id);
        $productDelete->delete();
        return redirect('profile')->with('success', 'Product is deleted Succesfully');
    }
}
