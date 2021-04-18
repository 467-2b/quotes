<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function customers(){
        $customers = Customer::all();
        return view('customers', ['customers' => $customers]);
    }

    public function quotes(){
            return view('quotes');
    }

    public function orders(){
        return view('orders');
    }

    public function newquote(){
        return view('newquote');
}
}
