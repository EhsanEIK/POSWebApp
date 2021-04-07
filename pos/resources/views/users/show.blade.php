@extends('users.users_layout')

@section('title','Show User')

@section('user_content')

    @section('user_card')
        <div class="row">
            <!-- Total Sales Card -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $totalSales = 0;
                                        foreach ($user->SaleInvoice as $saleInvoice)
                                        {
                                            $totalSales += $saleInvoice->SaleItem()->sum('total');
                                        }
                                    ?>
                                    {{$totalSales}} Tk.
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Purchases Card -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Purchases</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $totalPurchases = 0;
                                        foreach ($user->PurchaseInvoice as $purchaseInvoice)
                                        {
                                            $totalPurchases += $purchaseInvoice->PurchaseItem()->sum('total');
                                        }
                                    ?>
                                    {{$totalPurchases}} Tk.
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Payments Card -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Payments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalPayments = $user->Payment()->sum('amount')}} Tk.
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Receipts Card -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Receipts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalReceipts = $user->Receipt()->sum('amount')}} Tk.
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $totalBalance = ($totalPurchases+$totalReceipts) - ($totalSales+$totalPayments)
            ?>
            <!-- Total Balance Card -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Balance</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @if($totalBalance > 0)
                                        {{$totalBalance}} Tk.
                                    @else
                                        {{0}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Balance Card -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Due:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @if($totalBalance < 0)
                                        {{$totalBalance}} Tk.
                                    @else
                                        {{0}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection


    <!-- User Info DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informtaion of <strong>{{$user->name}}</strong></h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th class="text-right">Group :</th>
                                <td>{{$user->group->title}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Name :</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">E-mail :</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Phone :</th>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Address :</th>
                                <td>{{$user->address}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>

@endsection