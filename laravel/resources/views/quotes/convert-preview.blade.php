@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form method="POST">
                    @csrf
                    <div class="card-header text-center h4">
                    Are you sure you want to process this order?
                    </div>
                    <div class="card-body">
                        <div class="form-group row form-group-lg">
                            <label for="purchase_order_id" class="col-md-4 col-form-label text-md-right h4">{{ __('Purchase Order ID') }}</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-lg input-lg" name="purchase_order_id" value="{{ $purchase_order_id }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_amount" class="col-md-4 col-form-label text-md-right h4">{{ __('Total amount') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="total_amount">{{ number_format($quote->final_total_amount_after_discounts, 2) }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_name" class="col-md-4 col-form-label text-md-right h4">{{ __('Customer Name') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_name">{{ $quote->customer_name }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_email" class="col-md-4 col-form-label text-md-right h4">{{ __('Contact Email') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_email">{{ $quote->customer_email }}</span>
                            </div>
                        </div>
                    @if($customer->contact != $quote->customer_email)
                        <div class="form-group row">
                            <label for="customer_contact" class="col-md-4 col-form-label text-md-right h4">{{ __('Contact (Other)') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_contact">{{ $customer->contact }}</span>
                            </div>
                        </div>
                    @endif
                        <div class="form-group row">
                            <label for="customer_address" class="col-md-4 col-form-label text-md-right h4">{{ __('Address') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_address">{{ $customer->street }}, {{ $customer->city }}</span>
                            </div>
                        </div>
                    @if($quote->status == 'sanctioned' && Auth::user()->can('convert quote'))
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" name="action" value="convert" class="btn btn-danger btn-lg">
                                    {{ __('Process order') }}
                                </button>
                            </div>
                        </div>
                    @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
