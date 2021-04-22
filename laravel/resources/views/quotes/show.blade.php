@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center h4">
                {{ __('Customer Info') }}
                </div>
                <div class="card-body">
                        <div class="form-group row">
                            <label for="customer_name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_name">{{ $quote->customer_name }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_email" class="col-md-4 col-form-label text-md-right">{{ __('Contact Email') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_email">{{ $quote->customer_email }}</span>
                            </div>
                        </div>
                    @if($customer->contact != $quote->customer_email)
                        <div class="form-group row">
                            <label for="customer_contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact (Other)') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_contact">{{ $customer->contact }}</span>
                            </div>
                        </div>
                    @endif
                        <div class="form-group row">
                            <label for="customer_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_address">{{ $customer->street }}, {{ $customer->city }}</span>
                            </div>
                        </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header text-center h4">Line Items</div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Item Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($line_items as $line_item)
                            <tr>
                                <td>{{$line_item->description}}</td>
                                <td class="text-right">{{ $line_item->price }}</td>
                                <td class="text-right">{{ $line_item->quantity }}</td>
                                <td class="text-right">${{ number_format($line_item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td><strong>Items total<strong></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right">${{ number_format($quote->total_amount, 2) }}</td>
                            </tr>
                        @if($quote->discount_percent != 0)
                            <tr>
                                <td><strong>Discount percent<strong></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right">{{ $quote->discount_percent * 100 }}%</td>
                            </tr>
                        @endif
                        @if($quote->discount_amount != 0)
                            <tr>
                                <td><strong>Discount amount<strong></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right">${{ number_format($quote->discount_amount, 2) }}</td>
                            </tr>
                        @endif
                            <tr>
                                <td><strong>Final total after discount<strong></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right">${{ number_format($quote->final_total_amount_after_discounts, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header text-center h4">Notes</div>
                <div class="card-body">
                    @foreach($notes as $note)
                    <label for="note_{{ $note->id }}">{{ $note->created_at }}</label>
                    <textarea class="form-control mb-4" id="note_{{ $note->id }}" name="notes" style="width: 100%; max-width: 100%;">{{ $note->text }}</textarea>
                    @endforeach
                </div>
            </div>
            
            <div class="card">
                <div class="card-header text-center h4">Secret Notes</div>
                <div class="card-body">
                    @foreach($secret_notes as $note)
                    <label for="note_{{ $note->id }}">{{ $note->created_at }}</label>
                    <textarea class="form-control mb-4" id="note_{{ $note->id }}" name="notes" style="width: 100%; max-width: 100%;">{{ $note->text }}</textarea>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
