<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
                $commission = DB::table('users')->where('id', Auth::user()->id)->first()->accumulated_commission;
                return view('home', ['commission' => $commission]);
    }


    public function customers(){
        return view('customers');
    }

    public function quotes(){
            return view('quotes');
    }

    public function orders(){
        return view('orders');
    }
}
