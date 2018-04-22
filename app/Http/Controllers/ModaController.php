<?php

namespace App\Http\Controllers;

use App\Moda;
use App\Vendor;
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
        $vendors = Vendor::pluck('nama', 'nama');
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
        $namaModa = Moda::where('id',$selection)->first();
        $alamat = Vendor::where('nama',$namaModa->vendor)->value('alamat');
        
        // query jarak terdekat dari vendor
        $tonase = $namaModa->tonase;
        while ($tonase > 0) {
            // cari seluruh jarak dari vendor ke tempat
            $listJarak = Distance::where('origin', $alamat)->get();
            $list = [];
            foreach ($listJarak as $jarak) {
                $list[$jarak->dest] = $jarak->distance;
            }
            $listJarak = Distance::where('dest', $alamat)->get();
            foreach ($listJarak as $jarak) {
                $list[$jarak->origin] = $jarak->distance;
            }
            $originList = [];
            $dummy = ['tamansari','cblng'];
            foreach ($dummy as $dumm) {
                $originList[$dumm] = $list[$dumm];
            }
            asort($originList);
            dd($originList);
        }
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
