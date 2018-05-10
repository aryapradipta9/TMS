<?php

namespace App\Http\Controllers;

use App\Moda;
use App\Vendor;
use App\Customer;
use App\Order;
use App\Routing;
use Illuminate\Http\Request;
use App\Http\Requests\ModaReq;
use App\Distance;
use Carbon;
use Session;

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
        
        foreach ($modas as $value) {
            
            $value->vendor = Vendor::where('id', $value->vendor)->value('nama');
        }
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
        foreach ($modas as $value) {
            $value['vendor'] = Vendor::where('id', $value['vendor'])->value('nama');
        }
        return view('modaSelect', compact('modas'));
    }

    public function showDelete() {
        $modas = Moda::all();
        
        
        return view('modaDelete', compact('modas'));
    }


    public function select(Request $request)
    {
        $dummy = Session::get('list')->toArray(); // ambil seluruh order
        $totalTonase = 0;
        foreach ($dummy as $orderId) {
            $totalTonase += Order::where('id', $orderId)->value('berat');
        }

        $selection = $request->get('pickModa');
        // ambil lokasi vendor
        $namaModa = Moda::where('id', $selection)->first();
        
        if ($namaModa->tonase < $totalTonase) { // mobil saat ini tidak bisa menampung
            $otherTruck = Moda::where([
                ['tonase', '>=', $totalTonase],
                ['quantity', '>', 0]
            ])->get();
            
            if ($otherTruck->count() > 0) {
                // kasitau kl ada mobil lain yg bisa nampung
                $request->session()->flash('alert-route', 'Ada mobil yang bisa menampung');
                return redirect()->route('moda-show');
            }
        }
       
        $alamat = $namaModa->vendor * (-1);
        
        // $alamat = Vendor::where('nama', $namaModa->vendor)->value('alamat');
        
        // query jarak terdekat dari vendor
        $tonase = $namaModa->tonase;
        $end = false;
        
        $debug = array();
        // ambil group id
        $groupId = Routing::max('groupId');
        $groupId = isset($groupId) ? $groupId + 1 : 1;

        $i = 0;
        $totalJarak = 0;
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
            
            foreach ($dummy as $dumm) {
                // ambil data tujuan dari order
                $idTujuan = Order::where('id', $dumm)->value('customer');
                $originList[$dumm] = isset($list[$idTujuan]) ? $list[$idTujuan] : 999999999;
            }
            asort($originList);
            // ambil elemen pertama
            reset($originList);
            $nextDest = key($originList);
            $totalJarak = $totalJarak + $originList[$nextDest];
            
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
        $tonase = $namaModa->tonase - $tonase;
        $namaModa->quantity = $namaModa->quantity - 1;
        $namaModa->save();

        foreach ($debug as $value) {
            $order = Order::where('id', $value)->first();
            $routing = [];
            $routing['orderNumber'] = $value;
            $routing['totalJarak'] = $totalJarak;
            $routing['totalBerat'] = $tonase;
            $routing['deliveryDate'] = Carbon\Carbon::now();
            $routing['keterangan'] = 'ini keterangan';
            $routing['truck'] = $namaModa->id;
            $routing['groupId'] = $groupId;

            Routing::create($routing);
        }
        return redirect()->route('moda-select');
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

    public function destroy(Request $request)
    {
        if ($request->has('pick')) {
            foreach ($request->input('pick') as $value) {
                Moda::where('id', $value)->delete();

            }
        }
        return redirect()->route('moda');
    }
}
