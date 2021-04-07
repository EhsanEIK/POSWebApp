@extends('layout.main')

@section('title','Group')

@section('content')



<div class="row clearfix page-header">
	<div class="col-md-6">
		<h2>User Group List</h2>
	</div>

	<div class="col-md-6 text-right">
		<a class="btn btn-info" href="{{url('groups/create')}}"><i class="fa fa-plus"></i> New Group</a>
	</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All User Groups</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Title</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL No.</th>
                        <th>Title</th>
                        <th class="text-right">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                	<?php $i=0?>
                	@foreach($groups as $group)
                	<tr>
                		<td>{{++$i}}</td>
                		<td>{{$group->title}}</td>
                		<td class="text-right">
                			<form method="POST" action="{{url('groups/'.$group->id)}}">
                				@csrf
                				@method('DELETE')
                                <a href="{{ route ( 'groups.edit', ['id'=>$group->id] ) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                				<button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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