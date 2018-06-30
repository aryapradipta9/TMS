<?php

namespace App\Http\Controllers;

use App\Moda;
use App\Vendor;
use App\Customer;
use App\Order;
use App\Routing;
use App\History;
use Illuminate\Http\Request;
use App\Http\Requests\ModaReq;
use App\Distance;
use Carbon\Carbon;
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
            $value['duration'] .= ' hari';
            $value['startFrom'] = Carbon::createFromFormat('Y-m-d', $value['startFrom'])->format('d M Y');
            $value['endTo'] = Carbon::createFromFormat('Y-m-d', $value['endTo'])->format('d M Y');
            $dateNow = Carbon::now();
            if (Carbon::parse($value['endTo'])->lt($dateNow)) {
               $value['quantity'] = 0;
            }
            if (Carbon::parse($value['startFrom'])->gt($dateNow)) {
                $value['quantity'] = 0;
            }
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
            $value->vendor = Vendor::where('id', $value->vendor)->value('nama');
            $value['duration'] .= ' hari';
            $value['startFrom'] = Carbon::createFromFormat('Y-m-d', $value['startFrom'])->format('d M Y');
            $value['endTo'] = Carbon::createFromFormat('Y-m-d', $value['endTo'])->format('d M Y');
            $dateNow = Carbon::now();
            if (Carbon::parse($value['endTo'])->lt($dateNow)) {
               $value['quantity'] = 0;
            }
            if (Carbon::parse($value['startFrom'])->gt($dateNow)) {
                $value['quantity'] = 0;
            }
        }
        return view('modaSelect', compact('modas'));
    }

    public function showDelete() {
        $modas = Moda::all();
        foreach ($modas as $value) {
            $value->vendor = Vendor::where('id', $value->vendor)->value('nama');
            $value['duration'] .= ' hari';
            $value['startFrom'] = Carbon::createFromFormat('Y-m-d', $value['startFrom'])->format('d M Y');
            $value['endTo'] = Carbon::createFromFormat('Y-m-d', $value['endTo'])->format('d M Y');
            $dateNow = Carbon::now();
            if (Carbon::parse($value['endTo'])->lt($dateNow)) {
               $value['quantity'] = 0;
            }
            if (Carbon::parse($value['startFrom'])->gt($dateNow)) {
                $value['quantity'] = 0;
            }
        }
        
        return view('modaDelete', compact('modas'));
    }


    public function select(Request $request)
    {
        $dummy = Session::get('list')->toArray(); // ambil seluruh order
        

        $selection = $request->get('pickModa');
        // ambil lokasi vendor
        $namaModa = Moda::where('id', $selection)->first();

        $totalTonase = 0;
        foreach ($dummy as $orderId) {
            $order = Order::where('id', $orderId)->first();
            $totalTonase += $order->berat;
            $custid = Customer::where('id', $order->customer)->value('id');
            // pastikan seluruh alamat dari cust ada jarak lgsg dr vendor
            if (Distance::where([
                ['origin', $namaModa->vendor * (-1)],
                ['dest', $custid]
            ])->doesntExist()) {
                $distance = [];
                $distance['origin'] = $namaModa->vendor * (-1);
                $distance['dest'] = $custid;
                if ($distance['origin'] < 0) {
                    // adalah vendor
                    $tempOrigin = $distance['origin'] * (-1);
                    $origin = urlencode(Vendor::where('id', $tempOrigin)->value('alamat'));
                } else {
                }
                if ($distance['dest'] < 0) {
                } else {
                    $custLoc = Customer::where('id', $distance['dest'])->first();
                    $dest = $custLoc->alamat . ' ' . $custLoc->kecamatan . ' ' . $custLoc->kabupaten . ' ' . $custLoc->provinsi; 
                    $dest = urlencode($dest);
                }
                // $origin = urlencode($distance['origin']);
                // $dest = urlencode($distance['dest']);
                $url = 'https://maps.googleapis.com/maps/api/directions/json?key=AIzaSyB9RTBNGIx12uQTs3OhOjNUUhN6K8i_GvU&origin=' . $origin . '&destination=' . $dest;
                // dd($url);
                $json = json_decode(file_get_contents($url), true);
                // dd($url);
                $distance['distance'] = $json['routes'][0]['legs'][0]['distance']['value'] / 1000;
                
                // $customer = Request::all();
                // Mail delivery logic goes here

                Distance::create($distance);
            }
        }
        
        if (($namaModa->tonase < $totalTonase) && ($request->force == 0)) { // mobil saat ini tidak bisa menampung
            $otherTruck = Moda::where([
                ['tonase', '>=', $totalTonase],
                ['quantity', '>', 0]
            ])->get();
            if ($otherTruck->count() > 0) {
                // kasitau kl ada mobil lain yg bisa nampung
                $request->session()->flash('alert-route', "Ada mobil lain yang bisa menampung. Lanjutkan?");
                $request->session()->flash('prev-number', $selection);
                return redirect()->route('moda-show');
            }
        }
        $dateNow = Carbon::now();
        if (Carbon::parse($namaModa->endTo)->lt($dateNow)) {
            $request->session()->flash('alert-route', "Masa peminjaman mobil sudah selesai");
            return redirect()->route('moda-show');
        }
        if (Carbon::parse($namaModa->startFrom)->gt($dateNow)) {
            $request->session()->flash('alert-route', "Masa peminjaman mobil belum dimulai");
            return redirect()->route('moda-show');
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
            // buang data yg sizenya lebih besar dari truk
            $temp = [];
            foreach ($dummy as $dumm) {
                // ambil data tujuan dari order
                $dataOrder = Order::where('id', (int)$dumm)->first();
                $temp[] = $dataOrder;
                if ($dataOrder->berat <= $tonase ){
                    $idTujuan = $dataOrder->customer;
                    
                    $originList[$dumm] = isset($list[$idTujuan]) ? $list[$idTujuan] : 999999999;
                    
                }
            }
            
            if (count($originList) == 0) {
                $end = true;
            } else {
                asort($originList);
                // ambil elemen pertama
                reset($originList);
                $nextDest = key($originList);
                
                $order = Order::where('id', $nextDest)->first();
                
                // nextDest adalah id dari tujuan selanjutnya
                 
                $orderTonase = $order->berat;
                
                if ($tonase < $orderTonase) {
                    $end = true;
                } else {
                    $debug[] = $nextDest;
                    $i++;
                    $totalJarak = $totalJarak + $originList[$nextDest];
                
                    // masukkan ke database;
                    $order->status = 1;
                    $order->save();
                    $tonase = $tonase - $orderTonase;
                    $alamat = $order->customer;
                    array_splice($dummy, array_search($nextDest, $dummy), 1);
                }
            }
        }
        $tonase = $namaModa->tonase - $tonase;
        $namaModa->quantity = $namaModa->quantity - 1;
        $namaModa->save();
        $history = [];
        // dd($value);
        $iteration = 0;
        foreach ($debug as $value) {
            $order = Order::where('id', $value)->first();
            $routing = [];
            $routing['orderNumber'] = $value;
            $routing['totalJarak'] = $totalJarak;
            $routing['totalBerat'] = $tonase;
            $routing['deliveryDate'] = Carbon::now();
            $routing['keterangan'] = $order->keterangan;
            $routing['truck'] = $namaModa->id;
            $routing['groupId'] = $groupId;

            Routing::create($routing);
            
            if ($iteration == 0) {
                $namaWarehouse = Vendor::where('id', Moda::where('id', $routing['truck'])->value('vendor'))->value('nama');
                $history['rute'] = $namaWarehouse . ' --> ' . Customer::where('id', Order::where('id', $value)->value('customer'))->value('nama');
                $history['totalJarak'] = $totalJarak;
                $history['totalBerat'] = $tonase;
                $history['deliveryDate'] = Carbon::now();
                $history['keterangan'] = $order->keterangan;
                $history['namaTruck'] = Moda::where('id', $namaModa->id)->value('nama');
                
            } else {
                $namaCust = Customer::where('id', Order::where('id', $value)->value('customer'))->value('nama');
                $history['rute'] = $history['rute'] . ' --> ' . $namaCust;
            }

            // $groupId2 = History::max('groupId');
            // $groupId2 = isset($groupId2) ? $groupId2 + 1 : 1;
            // $routing['groupId'] = $groupId2;
            // History::create($routing);

            $iteration += 1;
        }
        // dd($history);
        if (count($history) > 0) History::create($history);

        // lakukan pengisian history


        return redirect()->route('routing');
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
        $moda['plat'] = $request['plat'];
        $moda['quantity'] = 1;
        $moda['tonase'] = $request['tonase'];
        $moda['duration'] = $request['duration'];
        $moda['startFrom'] = $request['startFrom'];
        $carbonDate = Carbon::parse($moda['startFrom']);
        $moda['endTo'] = $carbonDate->addDays($moda['duration']);
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
