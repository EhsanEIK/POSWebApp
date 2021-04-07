@extends('users.users_layout')

@section('title','Show User Payment')

@section('user_content')
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Payments of <strong>{{$user->name}}</strong></h6>
                </div>
                <div class="col-md-5 text-right">
                    <h6 class="m-0 font-weight-bold text-primary"><strong>Group:</strong> {{$user->group->title}}</h6>
                </div> 
            </div>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Admin</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th class="text-right">{{$user->Payment->sum('amount')}}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i=0?>
                        @foreach($user->Payment as $payment)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{optional($payment->admin)->name}}</td>
                            <td>{{$payment->date}}</td>
                            <td class="text-right">{{$payment->amount}}</td>
                            <td>{{$payment->note}}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route ( 'users.payments.destroy', ['id'=>$user->id, 'payment_id' => $payment->id] )}}">
                                    @csrf
                                    @method('DELETE')
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