<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderReq;
use App\Customer;

class OrderController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            // query
            $dataCust = Customer::where('nama', $order['customer'])->first();
            $order['kecamatan'] = $dataCust['kecamatan'];
            $order['kabupaten'] = $dataCust['kabupaten'];
            $order['provinsi'] = $dataCust['provinsi'];
            $order['alamat'] = $dataCust['alamat'];
        }
        return view('orderTable', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck('nama', 'nama');
        return view('order', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderReq $orderReq)
    {
        $request = $orderReq->validated();
        
        $order = [];

        $order['orderNumber'] = $request['orderNumber'];
        $order['customer'] = $request['customer'];
        $order['quantity'] = $request['quantity'];
        $order['berat'] = $request['berat'];
        $order['deliveryDate'] = $request['deliveryDate'];
        $order['keterangan'] = $request['keterangan'];
        $order['status'] = '0';
        // $customer = Request::all();
        // Mail delivery logic goes here

        Order::create($order);
        
        return redirect()->route('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
