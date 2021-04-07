@extends('layout.main')

@section('title','Stocks')

@section('content')



<div class="row clearfix page-header">
	<div class="col-md-6">
		<h2>Stock Information</h2>
	</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Stock List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Purchases</th>
                        <th>Sales</th>
                        <th>Stocks</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL No.</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Purchases</th>
                        <th>Sales</th>
                        <th>Stocks</th>
                    </tr>
                </tfoot>
                <tbody>
                	<?php $i=0?>
                	@foreach($products as $product)
                	<tr>
                		<td>{{++$i}}</td>
                		<td>{{$product->category->title}}</td>
                		<td>{{$product->title}}</td>
                		<td>{{$totalPurchase = $product->PurchaseItem()->sum('quantity')}}</td>
                		<td>{{$totalSale = $product->SaleItem()->sum('quantity')}}</td>
                        <td>{{$totalPurchase - $totalSale}}</td>
                	</tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection