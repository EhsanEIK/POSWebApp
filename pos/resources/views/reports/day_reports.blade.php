@extends('layout.main')

@section('title','Day Reports')

@section('content')



<div class="row clearfix page-header">
	<div class="col-md-5">
		<h2>Day Reports</h2>
        <h6>Date: <strong>{{$from_date}}</strong> to <strong>{{$to_date}}</strong></h6>
        <a class="btn btn-success btn-sm"  href="{{route('reports.day_reports.pdf')}}">
            <i class="fa fa-download"> Generate PDF</i>
        </a>
	</div>

	<div class="col-md-7 text-right">
		{!! Form::open(['route' => ['reports.day_reports'], 'class'=>'form-inline', 'method'=>'GET']) !!}

          <label for="from_date" class="mr-sm-2">From:</label>
          {{Form::date('from_date', $from_date, ['class'=>'form-control mb-2 mr-sm-2', 'id'=>'from_date', 'required'])}}
          <label for="to_date" class="mr-sm-2">To:</label>
          {{Form::date('to_date', $to_date, ['class'=>'form-control mb-2 mr-sm-2', 'id'=>'to_date', 'required'])}}

          {{-- <button type="submit" class="btn btn-primary mb-2">Show</button> --}}
        {!! Form::close() !!}
	</div>
</div>


<!-- Card -->
<div class="row mt-3">

    <!-- Total Sales Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{number_format($saleItems->sum('total'),2)}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Purchases Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Purchases</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{number_format($purchaseItems->sum('total'),2)}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Payments Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Payments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{number_format($payments->sum('amount'),2)}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Receipts Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Receipts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{number_format($receipts->sum('amount'),2)}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Sale reports -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sale Reports</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm"  cellspacing="0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($saleItems as $saleItem)
                    <tr>
                        <td>{{$saleItem->title}}</td>
                        <td class="text-right">{{ number_format($saleItem->price,2)}}</td>
                        <td class="text-right">{{$saleItem->quantity}}</td>
                        <td class="text-right">{{number_format($saleItem->total,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{$saleItems->sum('quantity')}}</th>
                        <th class="text-right">{{number_format($saleItems->sum('total'),2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Purchase Reports -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Purchase Reports</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchaseItems as $purchaseItem)
                    <tr>
                        <td>{{$purchaseItem->title}}</td>
                        <td class="text-right">{{ number_format($purchaseItem->price,2)}}</td>
                        <td class="text-right">{{$purchaseItem->quantity}}</td>
                        <td class="text-right">{{ number_format($purchaseItem->total,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{$purchaseItems->sum('quantity')}}</th>
                        <th class="text-right">{{number_format($purchaseItems->sum('total'),2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Payments Report -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Payment Reports</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm" cellspacing="0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Phone</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i=0?>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->name}}</td>
                        <td>{{$payment->phone}}</td>
                        <td class="text-right">{{number_format($payment->amount,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{number_format($payments->sum('amount'),2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Receipt Reports -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Receipt Reports</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm" cellspacing="0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Phone</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i=0?>
                    @foreach($receipts as $receipt)
                    <tr>
                        <td>{{$receipt->name}}</td>
                        <td>{{$receipt->phone}}</td>
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