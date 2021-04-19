<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use Illuminate\Support\Facades\Validator;

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
     * Get a validator for an incoming newquote request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'associate_id' => ['required', 'int', 'exists:users,id'],
            'customer_id' => ['required', 'int', 'exists:legacydb.customers,id'],
            'customer_email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    /**
     * Create a new quote instance after a valid newquote submission.
     *
     * @param  array  $data
     * @return \App\Models\Quote
     */
    protected function create(array $data)
    {
        $customer_name = \App\Models\Customer::find($data['customer_id'])->name;
        return Quote::create([
            'associate_id' => $data['associate_id'],
            'customer_id' => $data['customer_id'],
            'customer_email' => $data['customer_email'],
            'customer_name' => $customer_name
        ]);
    }

    /**
     * Handle a newquote request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $quote = $this->create($request->all());
        return redirect(route('quote', $quote->id));
    }

    /**
     * Show the form to create a new quote
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new()
    {
        $customers = \App\Models\Customer::all();
        return view('newquote', compact('customers'));
    }

    /**
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quotes = Quote::all();
        return view('quotes', compact('quotes'));
    }

    /**
     * Show the quote info and edit forms
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function quote($id)
    {
        $customers = \App\Models\Customer::all();
        $quote = \App\Models\Quote::find($id);
        $line_items = $quote->line_items;
        $notes = $quote->notes->where('secret', false);
        $secret_notes = $quote->notes->where('secret', true);
        return view('quote', compact('customers', 'quote', 'line_items', 'notes', 'secret_notes'));
    }
}
