@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('Orders') }}</h4></div>
                <div class="card-body">
                    <table class="table table-striped ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Purchase Order ID</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Total</th>
                                <th scope="col">Submitted</th>
                                <th scope="col">Process Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                                <td>{{ $order->purchase_order_id }}</td>
                                <td>{{ $order->quote->customer_name }}</td>
                                <td class="text-right">{{ number_format($order->amount, 2) }}</td>
                                <td>{{ $order->created_at->isoformat('MMMM DD') }}</td>
                                <td>{{ $order->process_day }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection