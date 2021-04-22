<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        $quote = Quote::with('customer')->find($id);
        $customer = $quote->customer;
        $line_items = $quote->line_items;
        $notes = $quote->notes->where('secret', false);
        $secret_notes = $quote->notes->where('secret', true);
        return view('quotes.show', compact('quote', 'customer', 'line_items', 'notes', 'secret_notes'));
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

    /**
     * Convert a quote into an order
     * 
     * 
     */
    
    protected function convert(int $quote_id)
    {
        $quote = Quote::find($quote_id);
        $purchase_order_id = (string) Str::uuid();
        $request = [
            'order' => $purchase_order_id,
            'associate' => $quote->associate_id,
            'custid' => $quote->customer_id,
            'amount' => $quote->final_total_amount_after_discounts,
        ];
        $url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
        $response = Http::post($url, $request);
        $data = [
            'quote_id' => $quote_id,
            'purchase_order_id' => $purchase_order_id,
            'process_day' => \Carbon\Carbon::createFromFormat('Y/n/j', $response['processDay'])->format('Y-m-d'),
            'commission_percent' => intval((string) $response['commission']) / 100,
        ];
        $order = \App\Models\Order::create([
            'quote_id' => $data['quote_id'],
            'purchase_order_id' => $data['purchase_order_id'],
            'process_day' => $data['process_day'],
            'commission_percent' => $data['commission_percent'],
        ]);
        $earned_commission = round($request['amount'] * $data['commission_percent'], 2);
        $associate = User::find($quote->associate_id);
        $associate->increment('accumulated_commission', $earned_commission);
        return redirect(route('orders.show', $order->id)); 
    }
}
