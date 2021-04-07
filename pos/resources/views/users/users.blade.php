@extends('layout.main')

@section('title','Users')

@section('content')


<div class="row clearfix page-header">
	<div class="col-md-6">
		<div class="dropdown">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
            Select Group
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('users.index')}}">All Users</a>
            @foreach($groups as $group)
                <a class="dropdown-item" href="{{route('users.index')}}?group={{$group->id}}">{{$group->title}}</a>
            @endforeach
          </div>
        </div>
	</div>

	<div class="col-md-6 text-right">
        <a class="btn btn-info" href="{{ route ('users.create')}}"><i class="fa fa-plus"></i> New User</a>
	</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Group</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL No.</th>
                        <th>Group</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th class="text-right">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                	<?php $i=0?>
                	@foreach($users as $user)
                	<tr>
                		<td>{{++$i}}</td>
                		<td>{{$user->group->title}}</td>
                		<td>{{$user->name}}</td>
                		<td>{{$user->email}}</td>
                		<td>{{$user->phone}}</td>
                		<td class="text-right">
                			<form method="POST" action="{{ route ( 'users.destroy', ['user'=>$user->id] )}}">
                				@csrf
                				@method('DELETE')

                                <a href="{{ route ( 'users.show', ['user'=>$user->id] ) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                				<a href="{{ route ( 'users.edit', ['user'=>$user->id] ) }}" class="btn btn-warning btn-sm">
                					<i class="fa fa-edit"></i>
                				</a>

                                @if(
                                    $user->SaleInvoice()->count() == 0
                                    && $user->PurchaseInvoice()->count() == 0
                                    && $user->Payment()->count() == 0
                                    && $user->Receipt()->count() == 0
                                    )                               
                    				<button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                    				</button>
                                @endif
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