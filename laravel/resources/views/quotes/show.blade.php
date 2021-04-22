@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{ __('View quote') }} : {{ $quote->id }}
                </div>

                <div class="card-body">
                        <input type="hidden" name="associate_id" value="{{ Auth::id() }}">

                        <div class="form-group row">
                            <label for="customer_name" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <span id="customer_name">{{ $quote->customer_name }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_email" class="col-md-4 col-form-label text-md-right">{{ __('Contact Email') }}</label>

                            <div class="col-md-6">
                                <span id="customer_email">{{ $quote->customer_email }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact (Other)') }}</label>

                            <div class="col-md-6">
                                <span id="customer_contact">{{ $customer->contact }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <span id="customer_address">{{ $customer->street }}, {{ $customer->city }}</span>
                            </div>
                        </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Line items</div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Subtotal</th>
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
                                <td><strong>Total<strong></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right">${{ number_format($quote->total_amount, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Notes</div>
                <div class="card-body">
                    @foreach($notes as $note)
                    <label for="note_{{ $note->id }}">{{ $note->created_at }}</label>
                    <textarea class="form-control mb-4" id="note_{{ $note->id }}" name="notes" style="width: 100%; max-width: 100%;">{{ $note->text }}</textarea>
                    @endforeach
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Secret Notes</div>
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
