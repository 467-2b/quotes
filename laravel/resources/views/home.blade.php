@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('Dashboard') }}</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Big icons -->
                    <div class="d-flex flex-wrap p-1 mx-auto">
                        <div class="p-5">
                            <a href="/quotes" alt="New Quotes" title="New Quotes" class="text-dark text-decoration-none">
                                <img src="/img/chat.png" height=128 width=128 alt="New Quote">
                                <p class="text-center font-weight-bold">Quotes</p>
                            </a>
                        </div>
                        <div class="p-5">
                            <a href={{ route('customers') }} alt="Customers" title="Customers" class="text-dark text-decoration-none">
                                <img src="/img/notepad.png" height=128 width=128 alt="Customers">
                                <p class="text-center font-weight-bold">Customers</p>
                            </a>
                        </div>
                        <div class="p-5">
                            <a href="/users" alt="Users" title="Users" class="text-dark text-decoration-none">
                                <img src="/img/team.png" height=128 width=128 alt="Users">
                                <p class="text-center font-weight-bold">Users</p>
                            </a>
                        </div>
                        <div class="p-5">
                            <a href="/orders" alt="Orders" title="Orders" class="text-dark text-decoration-none">
                                <img src="/img/folder.png" height=128 width=128 alt="Orders">
                                <p class="text-center font-weight-bold">Orders</p>
                            </a>
                        </div>
                        <div class="p-5">
                            <a href="/users" alt="Users" title="Users" class="text-dark text-decoration-none">
                                <img src="/img/coins.png" height=128 width=128 alt="Uhh idk">
                                <p class="text-center font-weight-bold">?</p>
                            </a>
                        </div>
                    </div>
                    <!-- User's commissions -->
                    <h4 class="text-center"><span style="color: #222a80;">Your accumulated commissions:</span> <span style="color: #127522;">${{$commission}}</span></h4>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
