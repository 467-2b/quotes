@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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

                            <div class="col-md-8">
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

                            <div class="col-md-8">
                                <input id="customer_email" type="text" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ $quote->customer_email }}" required>

                                @error('customer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
                    <table class="table table-striped table-hover table-condensed" id="itemsTable">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($line_items as $line_item)
                            <tr id='item{{$line_item->id}}'>
                                <td>{{$line_item->description}}</td>
                                <td class="text-right">{{$line_item->price}}</td>
                                <td class="text-right">{{$line_item->quantity}}</td>
                                <td>
                                    <button class="edit-modal btn btn-info"
                                    data-info="{{$line_item->id}},{{$line_item->description}},{{$line_item->price}},
                                    {{$line_item->quantity}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    <button class="delete-modal btn btn-danger"
                                    data-info="{{$line_item->id}},{{$line_item->description}},{{$line_item->price}},
                                    {{$line_item->quantity}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                            <tr><<form class="form-horizontal" role="form">>
                                <td><input class="form-control" type="text" name="description" placeholder="Description"></td>
                                <td><input class="form-control" type="number" name="price" placeholder="Price"></td>
                                <td><input class="form-control" type="number" name="quantity" placeholder="Quantity"></td>
                                <!--td><input class="form-control" type="number" name="test" placeholder="test"></td-->
                                <td><button class="btn btn-primary" type="submit" id="create">
                                         <span class="glyphicon glyphicon-plus">ADD</span>
                                    </button></td>
                            </form></tr>
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

            <div id="myModal" class="modal hide fade" role="dialog" style="display:none;">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                            <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="description">Description:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="price">Price:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="quantity">Quantity:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="quantity">
                                    </div>
                                </div>
                            </form>
                            <div class="deleteContent" style="displaye:none;">
                                Are you sure you want to delete <span class="dname"></span> ? <span class="hidden did"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn actionBtn" data-dismiss="modal">
                                    <span id="footer_action_button" class='glyphicon'> </span>
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@push('script')
    <!--extra scripts-->
    <script src="//code.jquery.com/jquery-1.12.3.js" ></script>
    <!--script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" defer/-->
    <script>
    $(document).ready(function() {
        $('#itemsTable').DataTable();
    } );
    $(document).on('click', '.edit-modal', 
        function() {
                $('#footer_action_button').text("Update");
                $('#footer_action_button').addClass('glyphicon-check');
                $('#footer_action_button').removeClass('glyphicon-trash');
                $('.actionBtn').addClass('btn-success');
                $('.actionBtn').removeClass('btn-danger');
                $('.actionBtn').removeClass('delete');
                $('.actionBtn').addClass('edit');
                $('.modal-title').text('Edit');
                $('.deleteContent').hide();
                $('.form-horizontal').show();
                var stuff = $(this).data('info').split(',');
                fillmodalData(stuff)
                $('#myModal').modal('show');
        });

    function fillmodalData(details){
        var path = window.location.pathname.split('/');
        //$('#qid').val(path[2]);
        $('#id').val(details[0]);
        $('#description').val(details[1]);
        $('#price').val(details[2]);
        $('#quantity').val(details[3]);
    }

    $('.modal-footer').on('click', '.edit', function() 
    {
            $.ajax({
                type: 'post',
                url: '/api/lineitems/update',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id").val(),
                    'description': $('#description').val(),
                    'price': $('#price').val(),
                    'quantity': $('#quantity').val(),
                },
                success: function(data) {
                    if (data.errors){
                        $('#myModal').modal('show');
                        if(data.errors.description) {
                            $('.desc_error').removeClass('hidden');
                            $('.desc_error').text("Description can't be empty !");
                        }
                        if(data.errors.price) {
                            $('.price_error').removeClass('hidden');
                            $('.price_error').text("Price can't be empty !");
                        }
                        if(data.errors.quantity) {
                            $('.quant_error').removeClass('hidden');
                            $('.quant_error').text("Quantity can't be empty !");
                        }
                    }
                    else 
                    {
                        $('.error').addClass('hidden');
                        $('#item' + data.id).replaceWith("<tr id='item" + data.id + "'><td>" + data.description +
                            "</td><td class='text-right'>" + data.price + "</td><td class='text-right'>" + data.quantity +
                            "</td><td><button class='edit-modal btn btn-info' data-info='" + 
                            data.id+","+data.description+","+data.price+","+
                            data.quantity+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                             + data.id+","+data.description+","+data.price+","+data.quantity+
                             "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>"
                            );
                    }
                }
            });
    });

    $("#create").click(function() {
        var path = window.location.pathname.split('/');
        $.ajax({
            type: 'post',
            url: '/api/lineitems/create',
            data: {
                '_token': $('input[name=_token]').val(),
                'quote_id':$('#quote_id').val(path[2]),
                'description': $('input[name=description]').val(),
                'price': $('input[name=price]').val(),
                'quantity': $('input[name=quantity]').val(),
            },
            success: function(data) 
            {
                $('.error').addClass('hidden');
                $('#itemsTable').append("<tr id='item" + data.id + "'><td>" + data.description +
                "</td><td class='text-right'>" + data.price + "</td><td class='text-right'>" + data.quantity +
                "</td><td><button class='edit-modal btn btn-info' data-info='" + 
                data.id+","+data.description+","+data.price+","+data.quantity+
                "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                + data.id+","+data.description+","+data.price+","+data.quantity+
                "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>"
                );
            },
        });
        $('#quote_id').val('');
        $('#description').val('');
        $('#price').val('');
        $('#quantity').val('');
    });

    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[0] +" "+stuff[1]);
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/api/lineitems/destroy',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('#item' + $('.did').text()).remove();
            }
        });
    });
    </script>
@endpush
