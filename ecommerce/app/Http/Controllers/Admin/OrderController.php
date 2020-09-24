<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProducts;
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
        } else if (Auth::guard('admin')->user()->roles->pluck('id')->first() - 1 == 2) {
            $order->update([
                'status' => "3"
            ]);
        } else if (Auth::guard('admin')->user()->roles->pluck('id')->first() - 1 == 3) {
            $order->update([
                'status' => "4"
            ]);
        } else {
            $order->update([
                'status' => "5"
            ]);
        }

        return redirect()->back();
    }
}
