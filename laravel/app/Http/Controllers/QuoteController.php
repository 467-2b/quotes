<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Customer;
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
     * Handle a newquote request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $quote = Quote::create([
            'associate_id' => $data['associate_id'],
            'customer_id' => $data['customer_id'],
            'customer_email' => $data['customer_email'],
            'customer_name' => \App\Models\Customer::find($data['customer_id'])->name
        ]);
        return redirect(route('quotes.edit', $quote->id));
    }

    /**
     * Show the form to create a new quote
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $customers = Customer::all();
        return view('quotes.create', compact('customers'));
    }

    /**
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quotes = Quote::all();
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the quote info
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $customers = Customer::all();
        $quote = Quote::find($id);
        $line_items = $quote->line_items;
        $notes = $quote->notes->where('secret', false);
        $secret_notes = $quote->notes->where('secret', true);
        return view('quotes.view', compact('customers', 'quote', 'line_items', 'notes', 'secret_notes'));
    }

    /**
     * Show the quote info and edit forms
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $quote = Quote::find($id);
        $line_items = $quote->line_items;
        $notes = $quote->notes->where('secret', false);
        $secret_notes = $quote->notes->where('secret', true);
        return view('quotes.edit', compact('customers', 'quote', 'line_items', 'notes', 'secret_notes'));
    }

    /**
     * Update the quote.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $quote = Quote::find($id);
        $quote->update([
            'associate_id' => $data['associate_id'],
            'customer_id' => $data['customer_id'],
            'customer_email' => $data['customer_email'],
            'customer_name' => \App\Models\Customer::find($data['customer_id'])->name
        ]);
        return $this->edit($id);
    }
}
