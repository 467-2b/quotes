<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\LineItem;
use App\Models\Note;
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
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function my_unfinalized()
    {
        $quotes = Quote::where([['associate_id', \Illuminate\Support\Facades\Auth::id()], ['status', 'unfinalized']])->get();
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function my_finalized()
    {
        $quotes = Quote::where([['associate_id', \Illuminate\Support\Facades\Auth::id()], ['status', 'finalized']])->get();
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function finalized()
    {
        $quotes = Quote::where('status', 'finalized')->get();
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sanctioned()
    {
        $quotes = Quote::where('status', 'sanctioned')->get();
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the quotes list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function processed()
    {
        $quotes = Quote::where('status', 'processed')->get();
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
        $data = $request->all();
        $quote = Quote::find($id);
        $num_line_items = count($data['line_item_ids']);
        $num_notes = count($data['note_ids']);
        $num_secret_notes = count($data['secret_note_ids']);

        // Update line items
        for($i = 0; $i < $num_line_items; $i++) {
            if($data['line_item_ids'][$i] == "new") {
                if(!empty($data['description'][$i]) && !empty($data['price'][$i]) && !empty($data['quantity'][$i]) && $data['quantity'][$i] != 0) {
                    $line_item = LineItem::create([
                        'quote_id' => $quote->id,
                        'description' => $data['description'][$i],
                        'price' => $data['price'][$i],
                        'quantity' => $data['quantity'][$i],
                    ]);
                }
            } else {
                $line_item = LineItem::find($data['line_item_ids'][$i]);
                if($data['quantity'][$i] == 0) {
                    $line_item->delete();
                } elseif($line_item->description != $data['description'][$i] || $line_item->price != $data['price'][$i]  || $line_item->quantity != $data['quantity'][$i]) {
                    $line_item->update([
                        'description' => $data['description'][$i],
                        'price' => $data['price'][$i],
                        'quantity' => $data['quantity'][$i],
                    ]);
                }
            }
        }
        
        // Update notes
        for($i = 0; $i < $num_notes; $i++) {
            if($data['note_ids'][$i] == "new") {
                if(!empty($data['notes'][$i])) {
                    $line_item = Note::create([
                        'quote_id' => $quote->id,
                        'secret' => false,
                        'text' => $data['notes'][$i],
                    ]);
                }
            } else {
                $note = Note::find($data['note_ids'][$i]);
                if(empty($data['notes'][$i])) {
                    $note->delete();
                } else {
                    $note->update([
                        'text' => $data['notes'][$i],
                    ]);
                }
            }
        }
        
        // Update secret notes
        for($i = 0; $i < $num_secret_notes; $i++) {
            if($data['secret_note_ids'][$i] == "new") {
                if(!empty($data['secret_notes'][$i])) {
                    $line_item = Note::create([
                        'quote_id' => $quote->id,
                        'secret' => true,
                        'text' => $data['secret_notes'][$i],
                    ]);
                }
            } else {
                $note = Note::find($data['secret_note_ids'][$i]);
                if(empty($data['secret_notes'][$i])) {
                    $note->delete();
                } else {
                    $note->update([
                        'text' => $data['secret_notes'][$i],
                    ]);
                }
            }
        }
        $this->validator($data)->validate([
            'associate_id' => $data['associate_id'],
            'customer_id' => $data['customer_id'],
            'customer_email' => $data['customer_email'],
        ]);
        $update = [
            'associate_id' => $data['associate_id'],
            'customer_id' => $data['customer_id'],
            'customer_email' => $data['customer_email'],
            'customer_name' => \App\Models\Customer::find($data['customer_id'])->name,
        ];
        if(!empty($data['action'])) {
            switch($data['action']) {
                case "finalize":
                    $update['status'] = "finalized";
                    break;
                case "sanction":
                    $update['status'] = "sanctioned";
                    break;
            }
        }
        if(!empty($data['discount_percent'])) {
            $update['discount_percent'] = ((double) intval($data['discount_percent'])) / 100.0;
        }
        if(!empty($data['discount_amount'])) {
            $update['discount_amount'] = $data['discount_amount'];
        }
        $quote->update($update);
        if(!empty($data['action'])) {
            if($data['action'] == 'finalize' && $quote->status == 'finalized') {
                return redirect(route('quotes.show', $id));
            } elseif ($data['action'] == 'sanction' && $quote->status == 'sanctioned') {
                return redirect(route('quotes.show', $id));
            }
        }
        return $this->edit($id);
    }

    /**
     * Preview converting a quote into an order
     * 
     * 
     */
    protected function convert_preview(int $quote_id)
    {
        $quote = Quote::find($quote_id);
        $customer = $quote->customer;
        $purchase_order_id = (string) Str::uuid();
        return view('quotes.convert-preview', compact('quote', 'customer', 'purchase_order_id')); 
    }

    /**
     * Convert a quote into an order
     * 
     * 
     */
    protected function convert(Request $request, $quote_id)
    {
        $quote = Quote::find($quote_id);
        $request_data = $request->all();
        $purchase_order_id = $request_data['purchase_order_id'];
        $submission = [
            'order' => $purchase_order_id,
            'associate' => $quote->associate_id,
            'custid' => $quote->customer_id,
            'amount' => $quote->final_total_amount_after_discounts,
        ];
        $url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
        $response = Http::post($url, $submission);
        $data = [
            'quote_id' => $quote_id,
            'purchase_order_id' => $purchase_order_id,
            'amount' => $response['amount'],
            'process_day' => \Carbon\Carbon::createFromFormat('Y/n/j', $response['processDay'])->format('Y-m-d'),
            'commission_percent' => (double) intval((string) $response['commission']) / 100.0,
        ];
        $order = \App\Models\Order::create([
            'quote_id' => $data['quote_id'],
            'purchase_order_id' => $data['purchase_order_id'],
            'process_day' => $data['process_day'],
            'commission_percent' => $data['commission_percent'],
        ]);
        $quote->update(['status' => 'processed']);
        $earned_commission = round($submission['amount'] * $data['commission_percent'], 2);
        $associate = User::find($quote->associate_id);
        $associate->increment('accumulated_commission', $earned_commission);
        return redirect(route('orders.show', $order->id)); 
    }
}
