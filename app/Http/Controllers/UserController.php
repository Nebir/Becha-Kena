<?php

namespace App\Http\Controllers;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        $userId = $user->id;
        $productRows = Product::with(['category', 'tags'])->where('owner_id', '=', $userId)->get();

        $purchasingList = Order::with(['orderProductItems.productItem'])
            ->where('customer_id', '=', $userId)
            ->whereHas('orderProductItems', function ($q){
                $q->where('status', '=', 1);
            })
            ->get();
        /*return $purchasingList;*/
        $pending_orders = OrderDetail::with('productItem', 'order.customer')
                                        ->where('status', '=', 0)
                                        ->whereHas('productItem', function ($q) {
                                            $q->where('owner_id', '=', Auth::user()->id);
                                        })
                                        ->get();
        /*return $pending_orders;*/


       /*return $productName;*/
        return view('user.profile', [
            'user' => $user,
            'productRows' => $productRows,
            'purchasingList' => $purchasingList,
            'pending_orders' => $pending_orders
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.profile_edit',[
            'user' => $user
        ]);
    }

    public function editProfileForm(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department = $request->department;
        $user->reg_no = $request->reg_no;
        $user->contact_no = $request->contact_no;
        $user->address = $request->address;
        $user->save();
        return redirect('profile')->with('success', 'Profile is successfully updated!');
    }

    public function editAvatar(Request $request)
    {
        $id = Auth::user()->id;
        $image = $this->uploadFile($request->file('image'), '/images/users/');
        $user = User::find($id);
        $user->image = $image;
        $user->save();
        return redirect('profile')->with('success', 'Profile is successfully updated!');
    }
    public function index()
    {
        //
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
