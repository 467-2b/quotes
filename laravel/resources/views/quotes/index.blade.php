@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('Quotes') }}</h4></div>
                <div class="card-body">
                <div>
                <select id="statusFilter" class = "form-control" style="width:150px;">
                    <option value="">Any status</option>
                    <option value="unfinalized">unfinalized</option>
                    <option value="finalized">finalized</option>
                    <option value="sanctioned">sanctioned</option>
                </select>
                </div>
                    <table class="table table-striped " id="quotesTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Associate</th>
                                <th scope="col">Items</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes as $quote)
                            <tr>
                                <td><a href="{{ route('quotes.show', $quote->id) }}">{{$quote->id}}</a></td>
                                <td>{{$quote->customer_name}}</td>
                                <td>{{$quote->associate->name}}</td>
                                <td>{{$quote->line_items->count()}}</td>
                                <td>{{$quote->notes->count()}}</td>
                                <td>{{$quote->status}}</td>
                                <td class="text-right">${{number_format($quote->total_amount, 2)}}</td>
                                <td>{{$quote->created_at->isoformat('MMMM DD')}}</td>
                                <td>{{$quote->updated_at->isoformat('MMMM DD')}}</td>
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
@push('script')
    <script src="//code.jquery.com/jquery-1.12.3.js" ></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" defer/>
    <script>
    $(document).ready(function() {
        $('#quotesTable').DataTable({
            "searching":true
        });
        var table = $('#quotesTable').DataTable();
        $("#quotesTable_filter.dataTables_filter").append($("#statusFilter"));
        var categoryIndex = 0;
      $("#quotesTable th").each(function (i) 
      {
        if ($($(this)).html() == "Status") 
        {
          statusIndex = i; 
          return false;
        }
      });
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selected = $('#statusFilter').val()
          var status = data[statusIndex];
          if (selected === "" || status === selected) {
            return true;
          }
          return false;
        }
      );
      $("#statusFilter").change(function (e) {
        table.draw();
      });
      table.draw();
    });
    </script>
@endpush 
