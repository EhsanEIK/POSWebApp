@extends('users.users_layout')

@section('title','Show User Purchase')

@section('user_content')
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Invoices of <strong>{{$user->name}}</strong></h6>
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
                            <th>Challan No.</th>
                            <th>Date</th>
                            <th>Qty.</th>
                            <th>Total</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                            $i = 0;
                            $totalItem = 0;
                            $totalPurchase = 0;
                        ?>
                        @foreach($user->PurchaseInvoice as $purchaseInvoice)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{optional($purchaseInvoice->admin)->name}}</td>
                            <td>{{$purchaseInvoice->challan_no}}</td>
                            <td>{{$purchaseInvoice->date}}</td>
                            <td class="text-right">
                                <?php
                                    $itemQty = $purchaseInvoice->PurchaseItem()->sum('quantity');
                                    $totalItem += $purchaseInvoice->PurchaseItem()->sum('quantity');
                                ?>
                                {{$purchaseInvoice->PurchaseItem()->sum('quantity')}}
                            </td>
                            <td class="text-right">
                                <?php
                                    $totalPurchase += $purchaseInvoice->PurchaseItem()->sum('total');
                                ?>
                                {{$purchaseInvoice->PurchaseItem()->sum('total')}}
                            </td>
                            <td class="text-right">
                                <form method="POST" action="{{ route ( 'users.purchases.invoices.destroy', ['id'=>$user->id, 'invoice_id'=> $purchaseInvoice->id] )}}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route ( 'users.purchases.invoices.items', ['id'=>$user->id, 'invoice_id'=> $purchaseInvoice->id] ) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    
                                    @if($itemQty == 0)
                                        <button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right">Total:</th>
                            <th class="text-right">{{$totalItem}}</th>
                            <th class="text-right">{{$totalPurchase}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection