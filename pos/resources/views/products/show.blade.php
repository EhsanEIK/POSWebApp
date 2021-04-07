@extends('layout.main')

@section('title','Show Product')

@section('content')



<div class="row clearfix page-header">
	<div class="col-md-2">
		<a class="btn btn-info" href="{{ route ('products.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
	</div>

    <div class="col-md-2">
    
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$product->title}}</strong> Informtaion</h6>
    </div>
    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th class="text-right">Category :</th>
                            <td>{{$product->category->title}}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Title :</th>
                            <td>{{$product->title}}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Descrpition:</th>
                            <td>{{$product->description}}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Cost Price :</th>
                            <td>{{$product->cost_price}}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Sale Price :</th>
                            <td>{{$product->price}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection