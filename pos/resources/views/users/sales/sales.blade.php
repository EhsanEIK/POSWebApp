@extends('users.users_layout')

@section('title','Show User Sale')

@section('user_content')
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Sale Invoices of <strong>{{$user->name}}</strong></h6>
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
                            $grandTotal = 0;
                            $itemTotal = 0;
                        ?>
                        @foreach($user->SaleInvoice as $saleInvoice)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{ optional($saleInvoice->admin)->name}}</td>
                            <td>{{$saleInvoice->challan_no}}</td>
                            <td>{{$saleInvoice->date}}</td>  
                            <td class="text-right">
                                <?php
                                    $itemQty = $saleInvoice->SaleItem()->sum('quantity');
                                    $itemTotal += $saleInvoice->SaleItem()->sum('quantity');
                                ?>
                                {{$saleInvoice->SaleItem()->sum('quantity')}}
                            </td>
                                                     
                            <td class="text-right">
                                <?php
                                    $grandTotal += $saleInvoice->SaleItem()->sum('total');
                                ?>
                                {{$saleInvoice->SaleItem()->sum('total')}}
                            </td>
                            <td class="text-right">
                                <form method="POST" action="{{ route ( 'users.sales.invoices.destroy', ['id'=>$user->id, 'invoice_id'=>$saleInvoice->id] )}}">  

                                    <a href="{{ route ( 'users.sales.invoices.items', ['id'=>$user->id, 'invoice_id'=>$saleInvoice->id] ) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    
                                    @if($itemQty == 0)
                                        @csrf
                                        @method('DELETE')
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
                            <th class="text-right">{{$itemTotal}}</th>
                            <th class="text-right">{{$grandTotal}}</th>
                            <th class="text-right"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection