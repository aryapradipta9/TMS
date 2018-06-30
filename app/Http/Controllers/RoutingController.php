<?php

namespace App\Http\Controllers;

use App\Routing;
use App\Customer;
use App\Order;
use App\Moda;
use App\Vendor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoutingController extends Controller
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
        $routing = Routing::orderBy('groupId', 'asc')->get();
        $newRouting = [];
        $groupId = 0;
        foreach ($routing as $value) {
            if ($value['groupId'] != $groupId) {
                
                $groupId = $value->groupId;
                $custid = Order::where('id', $value['orderNumber'])->value('customer');
                $namaWarehouse = Vendor::where('id', Moda::where('id', $value['truck'])->value('vendor'))->value('nama');
                $value['truck'] = Moda::where('id', $value['truck'])->value('nama');
                $value['orderNumber'] = $namaWarehouse . ' --> ' . Customer::where('id', $custid)->value('nama');
                $value['deliveryDate'] = Carbon::createFromFormat('Y-m-d', $value['deliveryDate'])->format('d M Y');
                $newRouting[] = $value;
                
            } else {
                $custid = Order::where('id', $value->orderNumber)->value('customer');
                $namaCust = Customer::where('id', $custid)->value('nama');
                $last = end($newRouting);
                // $id = key($newRouting);
                $last['orderNumber'] = $last['orderNumber'] . ' --> ' . $namaCust;
            }
            
        }
        return view('routingTable', compact('newRouting'));
    }

    public function showDelete()
    {
        $routing = Routing::orderBy('groupId', 'asc')->get();
        $newRouting = [];
        $groupId = 0;
        foreach ($routing as $value) {
            if ($value['groupId'] != $groupId) {
                
                $groupId = $value->groupId;
                $custid = Order::where('id', $value['orderNumber'])->value('customer');
                $namaWarehouse = Vendor::where('id', Moda::where('id', $value['truck'])->value('vendor'))->value('nama');
                $value['truck'] = Moda::where('id', $value['truck'])->value('nama');
                $value['orderNumber'] = $namaWarehouse . ' --> ' . Customer::where('id', $custid)->value('nama');
                $value['deliveryDate'] = Carbon::createFromFormat('Y-m-d', $value['deliveryDate'])->format('d M Y');
                $newRouting[] = $value;
                
            } else {
                $custid = Order::where('id', $value->orderNumber)->value('customer');
                $namaCust = Customer::where('id', $custid)->value('nama');
                $last = end($newRouting);
                // $id = key($newRouting);
                $last['orderNumber'] = $last['orderNumber'] . ' --> ' . $namaCust;
            }
            
        }
        
        return view('routingDelete', compact('newRouting'));
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
     * @param  \App\Routing  $routing
     * @return \Illuminate\Http\Response
     */
    public function show(Routing $routing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Routing  $routing
     * @return \Illuminate\Http\Response
     */
    public function edit(Routing $routing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Routing  $routing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routing $routing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Routing  $routing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('pick')) {
            foreach ($request->input('pick') as $value) {
                $listOrder = Routing::where('groupId', $value)->get();
                // dd($listRoute);
                foreach ($listOrder as $order) {
                    Order::where('id', $order->orderNumber)->update(['status' => 2]);
                }
                // ambil nomor truk
                Moda::where('id', $listOrder[0]->truck)->increment('quantity');
                Routing::where('groupId', $value)->delete();
            }
        }
        return redirect()->route('routing');
    }

    public function details(Request $request, $id) {
        $id = (int)$id;
        $routing = Routing::where('groupId', (int)$id)->get();

        $orderNumberList = [];
        foreach ($routing as $value) {
            $orderNumberList = Order::where('id', $value->orderNumber)->get();
        }
        foreach ($orderNumberList as $order) {
            // query
            $dataCust = Customer::where('id', $order['customer'])->first();
            $order['customer'] = $dataCust['nama'];
            $order['kecamatan'] = $dataCust['kecamatan'];
            $order['kabupaten'] = $dataCust['kabupaten'];
            $order['provinsi'] = $dataCust['provinsi'];
            $order['alamat'] = $dataCust['alamat'];
            $order['deliveryDate'] = Carbon::createFromFormat('Y-m-d', $order['deliveryDate'])->format('d M Y');
        }
        $orders = $orderNumberList;
        return view('orderTable', compact('orders'));
    }
}
