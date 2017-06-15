<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function productOrder(Request $request, $id)
    {
        $producItem = Product::where('id', '=', $id)->first();
        //Cart::add($producItem->id, $producItem->name, $request->input('qty'), $producItem->unit_price);
        Cart::add(['id' => $producItem->id, 'name' => $producItem->name, 'qty' => $request->input('qty'), 'price' => $producItem->unit_price]);
        return redirect()->back()->with('success', 'A new product is successfully added to your cart!');
    }

    public function cancelOrder($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('success', 'A product is successfully removed from your cart!');
    }

    public function clearCart()
    {
        Cart::destroy();
        return redirect()->back();
    }

    public function checkout()
    {
        return view('product.checkout',[
            'cart' => Cart::content()
        ]);
    }

    public function checkoutPurchase(Request $request)
    {
        $authUser = Auth::user();
        $user_status = Auth::user()->status;

        if($user_status) {
            $order = new Order();
            $order->customer_id = $authUser->id;
            $order->total_price = floatval(str_replace(',', '', Cart::total()));

            $order->save();


            foreach (\Cart::content() as $orderItem) {

                $orderDetails = new OrderDetail();

                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $orderItem->id;
                $orderDetails->unit_price = $orderItem->price;
                $orderDetails->quantity = $orderItem->qty;
                $orderDetails->total_price = $orderItem->subtotal;
                $orderDetails->status = 0;
                $orderDetails->save();
            }

            Cart::destroy();

            return redirect(route('product'))
                ->with('success', 'Product is successfully ordered! Order another product');
        }

        else {
            $cartContent = \Cart::content();
            return view('order.user_alert',[
                'blacklisted' => $user_status,
                'cartContent'   => $cartContent
            ]);
        }

        /*$validator = Validator::make($request->all(), [
            'phone'   => 'required',
            'address'   => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }*/

        /*else
        {
            $user_status = Auth::user()->status;

            if($user_status) {
                $order = new Order();
                $order->customer_id = $authUser->id;
                $order->total_price = floatval(str_replace(',', '', Cart::total()));

                $order->save();


                foreach (\Cart::content() as $orderItem) {

                    $orderDetails = new OrderDetail();

                    $orderDetails->order_id = $order->id;
                    $orderDetails->product_id = $orderItem->id;
                    $orderDetails->unit_price = $orderItem->price;
                    $orderDetails->quantity = $orderItem->qty;
                    $orderDetails->total_price = $orderItem->subtotal;
                    $orderDetails->status = 0;
                    $orderDetails->save();
                }

                Cart::destroy();

                return redirect(route('product'))
                    ->with('success', 'Product is successfully ordered! Order another product');
            }

            else {
                $cartContent = \Cart::content();
                return view('order.user_alert',[
                    'blacklisted' => $user_status,
                    'cartContent'   => $cartContent
                ]);
            }
        }*/

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
