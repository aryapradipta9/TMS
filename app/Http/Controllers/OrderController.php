<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderReq;
use App\Customer;
use Session;
use Carbon\Carbon;

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
        $orders = Order::where('status','<','2')->get();
        foreach ($orders as $order) {
            // query
            $dataCust = Customer::where('id', $order['customer'])->first();
            $order['customer'] = $dataCust['nama'];
            $order['kecamatan'] = $dataCust['kecamatan'];
            $order['kabupaten'] = $dataCust['kabupaten'];
            $order['provinsi'] = $dataCust['provinsi'];
            $order['alamat'] = $dataCust['alamat'];
            $order['deliveryDate'] = Carbon::createFromFormat('Y-m-d', $order['deliveryDate'])->format('d M Y');
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
        $customers = Customer::pluck('nama', 'id');
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

        Order::create($order);
        
        return redirect()->route('order');
    }

    public function select(Request $request){
        $list = array();
        if ($request->has('pick')) {
            foreach ($request->input('pick') as $value) {
                $list[] = ($value);
            }
            Session::put('list', collect($list));
        }
        return redirect()->route('moda-select');
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
    public function destroy(Request $request)
    {
        if ($request->has('pick')) {
            foreach ($request->input('pick') as $value) {
                Order::where('id', $value)->delete();
            }
        }
        return redirect()->route('order');
    }

    public function showDelete() {
        $orders = Order::where('status','<','2')->get();
        foreach ($orders as $order) {
            // query
            $dataCust = Customer::where('id', $order['customer'])->first();
            $order['customer'] = $dataCust['nama'];
            $order['kecamatan'] = $dataCust['kecamatan'];
            $order['kabupaten'] = $dataCust['kabupaten'];
            $order['provinsi'] = $dataCust['provinsi'];
            $order['alamat'] = $dataCust['alamat'];
            $order['deliveryDate'] = Carbon::createFromFormat('Y-m-d', $order['deliveryDate'])->format('d M Y');
        }
        return view('orderDelete', compact('orders'));
    }
}
