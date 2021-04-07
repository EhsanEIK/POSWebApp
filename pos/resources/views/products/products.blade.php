@extends('layout.main')

@section('title','Products')

@section('content')



<div class="row clearfix page-header">
	<div class="col-md-6">
		<h2>Product List</h2>
	</div>

	<div class="col-md-6 text-right">
		<a class="btn btn-info" href="{{ route ('products.create')}}"><i class="fa fa-plus"></i> New Product</a>
	</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>Has Stock</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL No.</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>Has Stock</th>
                        <th class="text-right">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                	<?php $i=0?>
                	@foreach($products as $product)
                	<tr>
                		<td>{{++$i}}</td>
                		<td>{{$product->category->title}}</td>
                		<td>{{$product->title}}</td>
                		<td>{{$product->cost_price}}</td>
                		<td>{{$product->price}}</td>
                        <td>{{($product->has_stock==1)?'Yes':'No'}}</td>
                		<td class="text-right">
                			<form method="POST" action="{{ route ( 'products.destroy', ['product'=>$product->id] )}}">
                				@csrf
                				@method('DELETE')

                                <a href="{{ route ( 'products.show', ['product'=>$product->id] ) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                				<a href="{{ route ( 'products.edit', ['product'=>$product->id] ) }}" class="btn btn-warning btn-sm">
                					<i class="fa fa-edit"></i>
                				</a>
                				<button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                				</button>
                			</form>
                		</td>
                	</tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection