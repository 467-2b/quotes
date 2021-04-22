@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST">
                <input type="hidden" name="associate_id" value="{{ $quote->associate_id }}" />
                <div class="card">
                    <div class="card-header text-center h4">
                    {{ __('Quote') }} {{ $quote->id }}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Quote Status') }}</label>
                            <div class="col-md-8">
                                <span class="h4" id="customer_name">{{ $quote->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center h4">{{ __('Customer Info') }}</div>
                    <div class="card-body">
                        @csrf

                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>
                            <div class="col-md-8">
                                <select id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" required autofocus>
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

                            <div class="col-md-8">
                                <input id="customer_email" type="text" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ $quote->customer_email }}" required>

                                @error('customer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="card">
                    <div class="card-header text-center h4">Line items</div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-hover table-condensed" id="line-items">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($line_items as $line_item)
                                <tr>
                                    <td><input class="form-control" type="text" name="description[]" value="{{$line_item->description}}" /><input type="hidden" name="line_item_ids[]" value="{{$line_item->id}}" /></td>
                                    <td><input class="form-control" type="number" name="price[]" step="0.01" value="{{number_format($line_item->price, 2)}}" /></td>
                                    <td><input class="form-control" type="number" name="quantity[]" step="1" value="{{$line_item->quantity}}" /></td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td><input class="form-control" type="text" name="description[]" placeholder="Description" /><input type="hidden" name="line_item_ids[]" value="new" /></td>
                                    <td><input class="form-control" type="number" name="price[]" step="0.01" placeholder="Price" /></td>
                                    <td><input class="form-control" type="number" name="quantity[]" step="1" placeholder="Quantity" /></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="description[]" placeholder="Description" /><input type="hidden" name="line_item_ids[]" value="new" /></td>
                                    <td><input class="form-control" type="number" name="price[]" step="0.01" placeholder="Price" /></td>
                                    <td><input class="form-control" type="number" name="quantity[]" step="1" placeholder="Quantity" /></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="description[]" placeholder="Description" /><input type="hidden" name="line_item_ids[]" value="new" /></td>
                                    <td><input class="form-control" type="number" name="price[]" step="0.01" placeholder="Price" /></td>
                                    <td><input class="form-control" type="number" name="quantity[]" step="1" placeholder="Quantity" /></td>
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
                        <textarea class="form-control mb-4" id="note_{{ $note->id }}" name="notes[]" style="width: 100%; max-width: 100%;">{{ $note->text }}</textarea><input type="hidden" name="note_ids[]" value="{{$note->id}}" />
                        @endforeach
                        <textarea class="form-control mb-4" id="note_new" name="notes[]" style="width: 100%; max-width: 100%;" placeholder="Add notes"></textarea><input type="hidden" name="note_ids[]" value="new" />
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header text-center h4">Secret Notes</div>
                    <div class="card-body">
                        @foreach($secret_notes as $note)
                        <label for="note_{{ $note->id }}">{{ $note->created_at }}</label>
                        <textarea class="form-control mb-4" id="note_{{ $note->id }}" name="secret_notes[]"  style="width: 100%; max-width: 100%;">{{ $note->text }}</textarea></textarea><input type="hidden" name="secret_note_ids[]" value="{{$note->id}}" />
                        @endforeach
                        <textarea class="form-control mb-4" id="note_new" name="secret_notes[]" style="width: 100%; max-width: 100%;" placeholder="Add secret notes"></textarea><input type="hidden" name="secret_note_ids[]" value="new" />
                    </div>
                </div>

                @if(
            ($quote->status == 'unfinalized' && Auth::user()->can('edit own quote') && $quote->associate_id = Auth::id()) ||
            ($quote->status == 'finalized' && Auth::user()->can('edit finalized quote')) ||
            ($quote->status == 'finalized' && Auth::user()->can('sanction quote')) ||
            ($quote->status == 'sanctioned' && Auth::user()->can('convert quote'))
        )
            <div class="card">
                <div class="card-header text-center h4">Actions</div>
                <div class="card-body">
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                        @if(($quote->status == 'unfinalized' && Auth::user()->can('edit own quote') && $quote->associate_id = Auth::id()) || ($quote->status == 'finalized' && Auth::user()->can('edit finalized quote')))
                            <button type="submit" name="action" value="save" class="btn btn-primary btn-lg">
                                {{ __('Save') }}
                            </button>
                        @endif
                        @if($quote->status == 'unfinalized' && Auth::user()->can('finalize quote') && $quote->associate_id = Auth::id())
                            <button type="submit" name="action" value="finalize" class="btn btn-success btn-lg">
                                {{ __('Finalize quote') }}
                            </button>
                        @endif
                        @if($quote->status == 'finalized' && Auth::user()->can('sanction quote'))
                            <button type="submit" name="action" value="sanction" class="btn btn-success btn-lg">
                                {{ __('Sanction quote') }}
                            </button>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
            </form>
        </div>
    </div>
</div>
@endsection
