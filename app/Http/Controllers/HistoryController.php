<?php

namespace App\Http\Controllers;

use App\Routing;
use App\History;
use App\Moda;
use App\Order;
use App\Customer;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routing = History::orderBy('groupId', 'asc')->get();
        $newRouting = [];
        $groupId = 0;
        foreach ($routing as $value) {
            if ($value['groupId'] != $groupId) {
                
                $groupId = $value->groupId;
                $custid = Order::where('id', $value['orderNumber'])->value('customer');
                $value['truck'] = Moda::where('id', $value['truck'])->value('nama');
                $value['orderNumber'] = Customer::where('id', $custid)->value('nama');
                $newRouting[] = $value;
                
            } else {
                $custid = Order::where('id', $value->orderNumber)->value('customer');
                $namaCust = Customer::where('id', $custid)->value('nama');
                $last = end($newRouting);
                // $id = key($newRouting);
                $last['orderNumber'] = $last['orderNumber'] . ' --> ' . $namaCust;
            }
            
        }
        return view('historyTable', compact('newRouting'));
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
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
