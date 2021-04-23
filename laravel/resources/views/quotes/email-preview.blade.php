@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form method="POST" action="{{ route('quotes.sanction', $id) }}">
                    @csrf
                    <div class="card-header text-center h4">
                    Preview the quote email before sending it.
                    </div>
                    <div class="card-body" style="height: 760px; display: block; border: none; overflow: hidden;">
                        <iframe src="{{ route('quotes.email-preview-raw', $id) }}" style="display: block; width: 100%; height: 100%; border: none; overflow: hidden;"></iframe>
                    </div>
                    <button type="submit" class="form-control form-control-lg btn btn-big btn-warning" name="action" value="saction">Sanction quote & send email</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
