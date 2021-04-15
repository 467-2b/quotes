@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <form>
                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email-Address</th>
                                    <th>Address</th>
                                    <th class="text-right">Commissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><a href="/user/{{$user->username}}">{{$user->username}}</a></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->address}}</td>
                                        <td class="text-right">${{number_format($user->accumulated_commission, 2)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                        <a class="btn btn-primary" href="/register" role="button">Add new user</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
