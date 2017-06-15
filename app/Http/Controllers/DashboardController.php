<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }
     /* @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function dashboard()
    {
        $authUser = Auth::user();
        /* Site Overview */
        $userCount = User::count();
        $productCount = Product::count();
        $completedOrdersCount = OrderDetail::where('status', '=', '1')->count();

        /* Daily Order and price count*/
        $dailyOrders = Order::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get();
        $dailyOrderCount =  $dailyOrders->count();
        $price_total = 0;
        foreach ($dailyOrders as $order) {
            $price_total += $order->total_price;
        }

        /* Monthly Statistics*/
        $data = OrderDetail::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->select(DB::raw('DATE(created_at) as day_num') ,DB::raw('count(*) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        /*return $data;*/

        $daysArray = [];
        $dailyOrderCounts = [];
        for($i = 1; $i <= Carbon::now()->endOfMonth()->day; $i++){
            array_push($daysArray, $i);
            array_push($dailyOrderCounts, 0);
        }
        /*return response()->json([$daysArray, $dailyOrderCounts]);*/
        foreach ($data as $orderData) {
            $day = date('j', strtotime($orderData->day_num));
            $dailyOrderCounts[$day] = $orderData->total;
        }

        $lastOrders = OrderDetail::with(['productItem', 'order', 'productItem.productOwner', 'order.customer'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        /*return $lastOrders;*/

        return view('dashboard.index', [
            'authUser'  => $authUser,
            'userCount' => $userCount,
            'productCount' => $productCount,
            'completedOrdersCount' => $completedOrdersCount,
            'dailyOrderCount' => $dailyOrderCount,
            'price_total' => $price_total,
            'daysArray' => $daysArray,
            'dailyOrderCounts' => $dailyOrderCounts,
            'lastOrders' => $lastOrders
        ]);
    }

    public function users()
    {
        $authUser = Auth::user();
        $users = User::where('status', '=', '1')->get();
        return view('dashboard.users', [
            'authUser'  => $authUser,
            'users'     => $users
        ]);
    }

    public function doBlacklist($blacklistId)
    {
        $user = User::find($blacklistId);
        $user->status = 0;
        $user->save();
        return redirect('users');

    }

    public function blacklistedUsers()
    {
        $authUser = Auth::user();
        $users = User::where('status', '=', '0')->get();
        return view('dashboard.blacklisted_users', [
            'authUser'  => $authUser,
            'users'     => $users
        ]);
    }

    public function removeBlacklist($blacklistId)
    {
        $user = User::find($blacklistId);
        $user->status = 1;
        $user->save();
        return redirect('blacklisted');
    }

    public function admins()
    {
        $authUser = Auth::user();
        $users = User::where('role', '=', 'Admin')->get();
        /*return $users;*/
        return view('dashboard.admins', [
            'authUser'  => $authUser,
            'users'     => $users
        ]);
    }

    public function makeAdmin($userId)
    {
        $user = User::find($userId);
        $user->role = 'Admin';
        $user->save();
        return redirect('users');
    }

    public function removeAdmin($userId)
    {
        $user = User::find($userId);
        $products = Product::get();

        foreach($products as $product){
            $productOwner = $product->owner_id;
            if($productOwner == $user->id) {
                $user->role = 'Owner';
                $user->save();
                return redirect('admins');
            }
        }
        $user->role = 'Public';
        $user->save();
        return redirect('admins');
    }

    public function products()
    {
        $authUser = Auth::user();
        $products = Product::where('status', '=', '1')->with(['category', 'tags','productOwner'])->get();
        return view('dashboard.products', [
            'authUser'  => $authUser,
            'products'  => $products
        ]);
    }

    public function pendingProducts()
    {
        $authUser = Auth::user();
        $products = Product::where('status', '=', 'false')->with(['category', 'tags','productOwner'])->get();
        /*return $products;*/
        return view('dashboard.pending_products', [
            'authUser'  => $authUser,
            'products'  => $products
        ]);
    }

    public function approveProduct($productId)
    {
        $product = Product::find($productId);
        $product->status = 1;
        $product->save();
        return redirect('pendingProducts');
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        $product->delete();
        return redirect('products')->with('success', 'Product is deleted succesfully');
    }

    public function categories()
    {
        $authUser = Auth::user();
        $categories = Category::get();
        $categoryCount = Category::count() + 1;
        return view('dashboard.categories', [
            'authUser'  => $authUser,
            'categories'  => $categories,
            'categoryCount' => $categoryCount
        ]);
    }

    public function createCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
            $image = $this->uploadFile($request->file('image'), '/images/categories/');
        else
            $image = '/images/categories/default.png';

        $category = new Category();
        $category->name = $request->name;
        $category->image = $image;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect('categories')->with('success', 'A new product is successfully created!');
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $category->delete();
        return redirect('categories')->with('success', 'Category is deleted Succesfully');
    }

    public function orderHistory()
    {
        $authUser = Auth::user();
        $orderDetails = OrderDetail::with(['productItem', 'order', 'productItem.productOwner', 'order.customer'])->get();

        return view('dashboard.order_history', [
            'authUser'  => $authUser,
            'orderDetails'  => $orderDetails
        ]);
    }

    public function productOrder()
    {
        $authUser = Auth::user();
        $productItems = Product::with('productOwner', 'category')->get();
        $productCount = $productItems->count();
        $productOrderCount = [];
        foreach ($productItems as $productItem) {
            $productOrderCount[] = OrderDetail::with('productItem')
                ->where('product_id', '=', $productItem->id)
                ->count();
        }
        /*return $productOrderCount;*/
        return view('dashboard.product_order', [
            'authUser'  => $authUser,
            'productItems'  => $productItems,
            'productCount' => $productCount,
            'productOrderCount' => $productOrderCount
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
