@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('Quotes') }}</h4></div>
                <div class="card-body">
                    <table class="table table-striped ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Customer</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Associate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes as $quote)
                            <tr>
                                <td>{{$quote->customer_name}}</td>
                                <td>{{$quote->status}}</td>
                                <td>{{$quote->total_amount}}</td>
                                <td>{{$quote->created_at->isoformat('MMMM DD')}}</td>
                                <td>{{$quote->updated_at->isoformat('MMMM DD')}}</td>
                                <td>{{$quote->associate->name}}</td>
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