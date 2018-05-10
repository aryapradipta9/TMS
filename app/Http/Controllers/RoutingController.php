<?php

namespace App\Http\Controllers;

use App\Routing;
use App\Customer;
use App\Order;
use Illuminate\Http\Request;

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
                $value['orderNumber'] = Customer::where('id', $custid)->value('nama');
                $newRouting[] = $value;
                
            } else {
                $custid = Order::where('id', $value->orderNumber)->value('customer');
                $namaCust = Customer::where('id', $custid)->value('nama');
                $last = end($newRouting);
                // $id = key($newRouting);
                $last['orderNumber'] = $last['orderNumber'] . ', ' . $namaCust;
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
                $value['orderNumber'] = Customer::where('id', $custid)->value('nama');
                $newRouting[] = $value;
                
            } else {
                $custid = Order::where('id', $value->orderNumber)->value('customer');
                $namaCust = Customer::where('id', $custid)->value('nama');
                $last = end($newRouting);
                // $id = key($newRouting);
                $last['orderNumber'] = $last['orderNumber'] . ', ' . $namaCust;
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
                    Order::where('id', $order->orderNumber)->update(['status' => 0]);
                }
                Routing::where('groupId', $value)->delete();
            }
        }
        return redirect()->route('routing');
    }
}
