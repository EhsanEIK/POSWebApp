@extends('layout.main')

@section('content')

<h2 style="text-transform: uppercase;">Welcome Admin: <strong>{{Auth::user()->name}}</strong></h2>
<h5>This is POS Management System</h5>

	<!-- Content Row -->
	<div class="row mt-3">

	    <!-- Total Users Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Users</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalUsers}}</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-users fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Total Products Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Products</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProducts}}</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Total Stocks Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Stocks</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalStocks}}</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Cash In Hand Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Cash In Hand</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalReceipts - $totalPayments}} Tk.</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Total Purchases Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Purchases</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPurchases}} Tk.</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Total Sales Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Sales</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalSales}} Tk.</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Total Payments Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Payments</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPayments}} Tk.</div>
	                    </div>
	                    <div class="col-auto">
	                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Total Receipts Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	        <div class="card border-left-success shadow h-100 py-2">
	            <div class="card-body">
	                <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
	                            Total Receipts</div>
	                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalReceipts}} Tk.</div>
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