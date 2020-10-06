<?php

namespace App\Http\Controllers\API;

use App\Color;
use App\Events\Ordered;
use App\Events\userOrder;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        event(new Ordered("يوجد لديك طلب جديد"));
        $code = Str::random(8);
        $Order = new Order();
        $Order->code = $code;
        $Order->status = "1";
        $Order->user_id = Auth::user()->id;
        $this->user->ordersR()->save($Order);

        foreach ($request->orderProducts as $key => $orderProduct) {
            OrderProducts::create([
                'order_id' => $Order->id,
                'quantity' => $orderProduct['quantity'],
                'color_id' => $orderProduct['color_id'],
                'size_id' => $orderProduct['size_id'],
                'product_id' => $orderProduct['product_id'],
            ]);
        }

        return response()->json([
            'success' => true,
            'products' => $request->orderProducts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function my_orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->with('orderProductsR')->get();
        $orders = $orders->map(function ($order) {
            if ($order->status == 1) {
                $order->status = "Ordered";
            } elseif ($order->status == 2) {
                $order->status = "Chopping";
            } elseif ($order->status == 3) {
                $order->status = "Finishing";
            } elseif ($order->status == 4) {
                $order->status = "Delivered";
            } else {
                $order->status = "Done";
            }
            return $order;
        });
        return response()->json([
            'orders' => $orders
        ]);
    }
}
