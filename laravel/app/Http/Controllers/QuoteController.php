<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
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
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function quotes()
    {
        $quotes = Quote::all();
        return view('quotes', ['quotes' => $quotes]);
    }   
}
