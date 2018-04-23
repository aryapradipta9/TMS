<?php

namespace App\Http\Controllers;

use App\Moda;
use App\Vendor;
use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\ModaReq;
use App\Distance;

class ModaController extends Controller
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
        $modas = Moda::all();

        return view('modaTable', compact('modas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::pluck('nama', 'id');
        return view('moda', compact('vendors'));
    }

    public function showModa()
    {
        $modas = Moda::all();

        return view('modaSelect', compact('modas'));
    }

    public function select(Request $request)
    {
        $selection = $request->get('pickModa');
        // ambil lokasi vendor
        $namaModa = Moda::where('id', $selection)->first();
        $alamat = $namaModa->vendor * (-1);
        
        // $alamat = Vendor::where('nama', $namaModa->vendor)->value('alamat');
        
        // query jarak terdekat dari vendor
        $tonase = $namaModa->tonase;
        $end = false;
        $dummy = [2,1,3];
        $debug = array();
        $i = 0;
        while ((!($end)) && (sizeof($dummy) > 0)) {
            // cari seluruh jarak dari vendor ke tempat
            $listJarak = Distance::where('origin', $alamat)->get();
            $list = array();
            $list[$alamat] = 0;
            foreach ($listJarak as $jarak) {
                $list[$jarak->dest] = $jarak->distance;
            }
            $listJarak = Distance::where('dest', $alamat)->get();
            foreach ($listJarak as $jarak) {
                $list[$jarak->origin] = $jarak->distance;
            }
            
            $originList = [];
            
            // if ($i == 1) dd($alamat);
            // dd($list);
            foreach ($dummy as $dumm) {
                // ambil data tujuan dari order
                $idTujuan = Order::where('id', $dumm)->value('customer');
                $originList[$dumm] = $list[$idTujuan];
            }
            asort($originList);
            // ambil elemen pertama
            reset($originList);
            $nextDest = key($originList);
            $order = Order::where('id', $nextDest)->first();
            
            // nextDest adalah id dari tujuan selanjutnya
            // var_dump($order);
            // 
            $orderTonase = $order->berat;
            
            if ($tonase < $orderTonase) {
                $end = true;
            } else {
                $debug[] = $nextDest;
                $i++;
                // masukkan ke database;
                $order->status = 1;
                $order->save();
                $tonase = $tonase - $orderTonase;
                // $alamat = Customer::where('nama', $order->customer)->value('kecamatan');
                $alamat = $order->customer;
                array_splice($dummy, array_search($nextDest, $dummy), 1);
                // dd($dummy);
            }
            
        }
        dd($debug);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModaReq $modareq)
    {
        $request = $modareq->validated();
        $moda = [];

        $moda['nama'] = $request['nama'];
        $moda['vendor'] = $request['vendor'];
        $moda['contact'] = $request['contact'];
        $moda['quantity'] = $request['quantity'];
        $moda['tonase'] = $request['tonase'];
        $moda['duration'] = $request['duration'];
        $moda['startFrom'] = $request['startFrom'];
        $moda['endTo'] = $request['endTo'];
        $moda['status'] = '0';
        // $customer = Request::all();
        // Mail delivery logic goes here

        Moda::create($moda);
        
        return redirect()->route('moda');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moda  $moda
     * @return \Illuminate\Http\Response
     */
    public function show(Moda $moda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moda  $moda
     * @return \Illuminate\Http\Response
     */
    public function edit(Moda $moda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moda  $moda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moda $moda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moda  $moda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moda $moda)
    {
        //
    }
}
