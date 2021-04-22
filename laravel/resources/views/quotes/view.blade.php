@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                @canany(['edit own quote', 'edit finalized quote'])
                {{ __('Edit quote') }}
                @elsecanany(['view finalized quote', 'view any quote'])
                {{ __('View quote') }}
                @endcan
                : {{$quote->id}}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('newquote') }}">
                        @csrf
                        <input type="hidden" name="associate_id" value="{{ Auth::id() }}">

                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <select disabled id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" required autofocus>
                                @foreach($customers as $customer)
                                    <option @if($quote->customer_id == $customer->id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_email" class="col-md-4 col-form-label text-md-right">{{ __('Contact Email') }}</label>

                            <div class="col-md-6">
                                <input id="customer_email" type="text" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ $quote->customer_email }}" required>

                                @error('customer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update quote') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($line_items as $line_item)
                            <tr>
                                <td>{{$line_item->description}}</td>
                                <td class="text-right">{{$line_item->price}}</td>
                                <td class="text-right">{{$line_item->quantity}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td><input class="form-control" type="text" name="description" placeholder="Description"></td>
                                <td><input class="form-control" type="number" name="price" placeholder="Price"></td>
                                <td><input class="form-control" type="number" name="quantity" placeholder="Quantity"></td>
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
                    <textarea class="form-control mb-4" id="note_new" name="notes" style="width: 100%; max-width: 100%;" placeholder="Add notes"></textarea>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Secret Notes</div>
                <div class="card-body">
                    @foreach($secret_notes as $note)
                    <label for="note_{{ $note->id }}">{{ $note->created_at }}</label>
                    <textarea class="form-control mb-4" id="note_{{ $note->id }}" name="notes" style="width: 100%; max-width: 100%;">{{ $note->text }}</textarea>
                    @endforeach
                    <textarea class="form-control mb-4" id="note_new" name="notes" style="width: 100%; max-width: 100%;" placeholder="Add secret notes"></textarea>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
