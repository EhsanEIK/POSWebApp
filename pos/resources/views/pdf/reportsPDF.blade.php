@extends('pdf.pdf_layout')
@section('title', 'Reports | PDF')

@section('pdf_body')
<div class="row clearfix">
    <div class="col-md-6">
        <table>
            <tr>
                <th>Name:</th>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>Group:</th>
                <td>{{$user->group->title}}</td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td>{{$user->phone}}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{$user->address}}</td>
            </tr>
        </table>
    </div>
</div>
<!-- Sale reports -->
<div class="card-header py-3 mt-3">
    <h6 class="m-0 font-weight-bold text-primary">Sale Reports</h6>
</div>
<div class="card shadow mb-4">
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
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Purchase Reports</h6>
</div>
<div class="card shadow mb-4">
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
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Payment Reports</h6>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i=0?>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->date}}</td>
                        <td class="text-right">{{number_format($payment->amount,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{number_format($payments->sum('amount'),2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Receipt Reports -->
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Receipt Reports</h6>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i=0?>
                    @foreach($receipts as $receipt)
                    <tr>
                        <td>{{$receipt->date}}</td>
                        <td class="text-right">{{number_format($receipt->amount,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{ number_format($receipts->sum('amount'),2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection



    