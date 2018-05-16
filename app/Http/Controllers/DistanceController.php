<?php

namespace App\Http\Controllers;

use App\Distance;
use Illuminate\Http\Request;
use App\Http\Requests\DistReq;
use App\Customer;
use App\Vendor;

class DistanceController extends Controller
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

        $distances = Distance::all();
        foreach ($distances as $distance) {
            if ($distance['origin'] < 0) {
                $distance['origin'] = Vendor::where('id', ($distance['origin'] * (-1) ))->value('nama');
            } else {
                $distance['origin'] = Customer::where('id', $distance['origin'])->value('nama');
            }
            if ($distance['dest'] < 0) {
                $distance['dest'] = Vendor::where('id', ($distance['dest'] * (-1) ))->value('nama');
            } else {
                $distance['dest'] = Customer::where('id', $distance['dest'])->value('nama');
            }
        }
        
        return view('distTable', compact('distances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck('nama', 'id')->toArray();
        $vendors = Vendor::pluck('nama', 'id')->toArray();
        $new = array();
        foreach($vendors as $key => $vendor) {
            $customers[$key * (-1)] = $vendor;
        }
        // $customers = $customers->merge($new);
        // dd($customers);
        return view('dist', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistReq $distReq)
    {
        $request = $distReq->validated();
        $distance = [];
        
        $distance['origin'] = $request['origin'];
        $distance['dest'] = $request['dest'];
        if ($distance['origin'] < 0) {
            // adalah vendor
            $tempOrigin = $distance['origin'] * (-1);
            $origin = urlencode(Vendor::where('id', $tempOrigin)->value('alamat'));
        } else {
            $origin = urlencode(Customer::where('id', $distance['origin'])->value('alamat'));
        }
        if ($distance['dest'] < 0) {
            // adalah vendor
            $tempDest = $distance['dest'] * (-1);
            $dest = urlencode(Vendor::where('id', $tempDest)->value('alamat'));
        } else {
            $dest = urlencode(Customer::where('id', $distance['dest'])->value('alamat'));
        }
        // $origin = urlencode($distance['origin']);
        // $dest = urlencode($distance['dest']);
        $url = 'https://maps.googleapis.com/maps/api/directions/json?key=AIzaSyB9RTBNGIx12uQTs3OhOjNUUhN6K8i_GvU&origin=' . $origin . '&destination=' . $dest;
        // dd($url);
        $json = json_decode(file_get_contents($url), true);
        // dd($json);
        $distance['distance'] = $json['routes'][0]['legs'][0]['distance']['value'] / 1000;
        
        // $customer = Request::all();
        // Mail delivery logic goes here

        Distance::create($distance);
        
        return redirect()->route('dist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function show(Distance $distance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function edit(Distance $distance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distance $distance)
    {
        //
    }

    public function showDelete() {
        $distances = Distance::all();
        foreach ($distances as $distance) {
            $distance['origin'] = Customer::where('id', $distance['origin'])->value('nama');
            $distance['dest'] = Customer::where('id', $distance['dest'])->value('nama');
        }
        
        return view('distDelete', compact('distances'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('pick')) {
            foreach ($request->input('pick') as $value) {
                Distance::where('id', $value)->delete();

            }
        }
        return redirect()->route('dist');
    }
}
