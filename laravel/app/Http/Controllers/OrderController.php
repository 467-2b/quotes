<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
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
     * Get a validator for an incoming neworder request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'quote_id' => ['required', 'int', 'exists:quotes,id'],
            'status' => ['required']
        ]);
    }

    public function create(array $data)
    {
        return Order::create([
            'quote_id' => $data['quote_id'],
            'purchase_order_id' => $data['purchase_order_id'],
            'process_day' => $data['process_day'],
            'commission' => $data['commission'],
        ]);
    }

    public function show($id)
    {
        $order = Order::find($id);
        $quote = Quote::find($order->quote_id);
        $customer = Customer::find($quote->customer_id);
        $line_items = $quote->line_items;
        $notes = $quote->notes->where('secret', false);
        $secret_notes = $quote->notes->where('secret', true);
        return view('orders.show', compact('order', 'quote', 'customer','line_items', 'notes', 'secret_notes'));
    }
}
