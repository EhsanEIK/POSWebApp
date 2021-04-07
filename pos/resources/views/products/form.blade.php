@extends('layout.main')

@section('title','Create Product')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="row clearfix page-header">
    <div class="col-md-6">
      <h2>{{$headline}}</h2>
    </div>

    <div class="col-md-6 text-right">
      <a class="btn btn-info" href="{{ route ('products.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
    </div>
</div>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$headline}}</h6>
    </div>

    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                
                @if($mode == 'edit')
                    {!! Form::model( $product, ['route' => ['products.update',$product->id], 'method'=>'PUT']) !!}

                @else
                    {!! Form::open(['route' => 'products.store', 'method'=>'POST']) !!}

                @endif

                  <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label text-right">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('title',NULL, ['class'=>'form-control', 'id'=>'title', 'required','placeholder'=>'Title'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-right">Description</label>
                    <div class="col-sm-9">
                      {{Form::textarea('description',NULL, ['class'=>'form-control', 'id'=>'description', 'placeholder'=>'Description'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="category_id" class="col-sm-3 col-form-label text-right">Category <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                      {{ Form::select('category_id', $categories , NULL, 
                      ['class'=>'form-control', 'id'=>'category_id', 'required', 'placeholder'=>'SELECT']) }}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="cost_price" class="col-sm-3 col-form-label text-right">Cost Price</label>
                    <div class="col-sm-6">
                      {{Form::text('cost_price',NULL, ['class'=>'form-control', 'id'=>'cost_price', 'required', 'placeholder'=>'Cost Price'])}}
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label text-right">Sale Price</label>
                    <div class="col-sm-6">
                      {{Form::text('price',NULL, ['class'=>'form-control', 'id'=>'price', 'required', 'placeholder'=>'Sale Price'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="has_stock" class="col-sm-3 col-form-label text-right">Has Stock </label>
                    <div class="col-sm-3">
                      {{ Form::select('has_stock', ['1'=>'Yes', '0'=>'No'] , NULL, 
                      ['class'=>'form-control', 'id'=>'has_stock', 'placeholder'=>'SELECT']) }}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-right"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary">{{$button}}</button>
                    </div>
                  </div>       
                  
                {!! Form::close() !!}   

            </div>
        </div>
    </div>
</div>

@endsection