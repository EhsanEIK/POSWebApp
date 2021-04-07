@extends('layout.main')

@section('title','Create Category')

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
      <a class="btn btn-info" href="{{ route ('categories.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
    </div>
</div>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$headline}}</h6>
    </div>

    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                
                @if($mode == 'edit')
                    {!! Form::model( $category, ['route' => ['categories.update',$category->id], 'method'=>'PUT']) !!}

                @else
                    {!! Form::open(['route' => 'categories.store', 'method'=>'POST']) !!}

                @endif

                  <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label text-right">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('title',NULL, ['class'=>'form-control', 'id'=>'title', 'placeholder'=>'Title'])}}
                    </div>
                  </div>


                  <div class="text-right">
                     <button type="submit" class="btn btn-primary">{{$button}}</button>
                  </div>         
                  
                {!! Form::close() !!}   

            </div>
        </div>
    </div>
</div>

@endsection