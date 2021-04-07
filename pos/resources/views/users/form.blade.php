@extends('layout.main')

@section('title','Create User')

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
      <a class="btn btn-info" href="{{ route ('users.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
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
                    {!! Form::model( $user, ['route' => ['users.update',$user->id], 'method'=>'PUT']) !!}

                @else
                    {!! Form::open(['route' => 'users.store', 'method'=>'POST']) !!}

                @endif

                

                  <div class="form-group row">
                    <label for="group_id" class="col-sm-3 col-form-label text-right">User Group <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{ Form::select('group_id', $groups , NULL, 
                      ['class'=>'form-control', 'id'=>'group_id', 'placeholder'=>'SELECT']) }}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('name',NULL, ['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label text-right">Phone <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('phone',NULL, ['class'=>'form-control', 'id'=>'phone', 'placeholder'=>'Phone'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">E-mail</label>
                    <div class="col-sm-9">
                      {{Form::text('email',NULL, ['class'=>'form-control', 'id'=>'email', 'placeholder'=>'E-mail'])}}
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label text-right">Address</label>
                    <div class="col-sm-9">
                      {{Form::text('address',NULL, ['class'=>'form-control', 'id'=>'address', 'placeholder'=>'Address'])}}
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