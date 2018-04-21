<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Request\CustomerAddRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
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

        $customers = Customer::all();

        return view('customerTable', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\CustomerAddRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = [];

        $customer['nama'] = $request->get('nama');
        $customer['mail'] = $request->get('mail');
        $customer['jenis'] = $request->get('jenis');
        $customer['alamat'] = $request->get('alamat');
        $customer['no_telp'] = $request->get('telp');
        $customer['contact_person'] = $request->get('contact');
        // $customer = Request::all();
        // Mail delivery logic goes here

        Customer::create($customer);

        return redirect()->route('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
