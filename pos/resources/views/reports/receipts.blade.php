@extends('layout.main')

@section('title','Receipt Reports')

@section('content')



<div class="row clearfix page-header">
    <div class="col-md-5">
        <h2>Receipt Reports</h2>
    </div>

    <div class="col-md-7 text-right">
        {!! Form::open(['route' => ['reports.receipts'], 'class'=>'form-inline', 'method'=>'GET']) !!}

          <label for="from_date" class="mr-sm-2">From:</label>
          {{Form::date('from_date', $from_date, ['class'=>'form-control mb-2 mr-sm-2', 'id'=>'from_date', 'required'])}}
          <label for="to_date" class="mr-sm-2">To:</label>
          {{Form::date('to_date', $to_date, ['class'=>'form-control mb-2 mr-sm-2', 'id'=>'to_date', 'required'])}}

          <button type="submit" class="btn btn-primary mb-2">Show</button>
        {!! Form::close() !!}
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reports from <strong>{{$from_date}}</strong> to <strong>{{$to_date}}</strong></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date ( Y-M-D )</th>
                        <th>User</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i=0?>
                    @foreach($receipts as $receipt)
                    <tr>
                        <td>{{$receipt->date}}</td>
                        <td>{{$receipt->user->name}}</td>
                        <td class="text-right">{{number_format($receipt->amount,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{ number_format($receipts->sum('amount'),2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection