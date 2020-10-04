<?php

namespace App\Http\Controllers\Admin;

use App\Events\Chopping;
use App\Events\Delivered;
use App\Events\Done;
use App\Events\Finishing;
use App\Http\Controllers\Controller;
use App\Materail;
use App\Order;
use App\OrderProducts;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->user()->roles->pluck('name')->first() == "superAdmin") {
            $orders = Order::all();
        } else {
            $orders = Order::where('status', Auth::guard('admin')->user()->roles->pluck('id')->first() - 1)
                ->with(['userR', 'orderProductsR'])
                ->get();
        }


        return view('admin.orders.index', compact('orders'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderProducts = OrderProducts::where('order_id', $id)->with(['productR', 'colorR', 'sizeR'])->get();

        return view('admin.orders.show', compact('orderProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function done($id)
    {
        $order = Order::find($id);
        if (Auth::guard('admin')->user()->roles->pluck('id')->first() - 1 == 1) {
            $order->update([
                'status' => "2"
            ]);
            $quantity = 0;
            foreach ($order->orderProductsR as $key => $pro) {
                $product = Product::where('id', $pro->product_id)->first();
                $quantityPro = ($pro->quantity * $product->quantity);
                $quantity = Materail::where('id', $product->materail_id)->select('quantity')->first();
                Materail::where('id', $product->materail_id)->update([
                    'quantity' => $quantity['quantity'] - $quantityPro,
                ]);
            }
            event(new Chopping("يوجد لديك طلب جديد"));

        } else if (Auth::guard('admin')->user()->roles->pluck('id')->first() - 1 == 2) {
            $order->update([
                'status' => "3"
            ]);
            event(new Finishing("يوجد لديك طلب جديد"));
        } else if (Auth::guard('admin')->user()->roles->pluck('id')->first() - 1 == 3) {
            $order->update([
                'status' => "4"
            ]);
            event(new Delivered("يوجد لديك طلب جديد"));
        } else {
            $order->update([
                'status' => "5"
            ]);
            event(new Done("يوجد لديك طلب جديد"));
        }

        return redirect()->back();
    }
}
