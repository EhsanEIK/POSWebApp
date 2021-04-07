@extends('layout.main')

@section('title')

@section('content')

@yield('user_card')

<div class="row clearfix page-header">
	<div class="col-md-2">
		<a class="btn btn-info" href="{{ route ('users.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
	</div>

	<div class="col-md-10 text-right">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newSaleInvoiceModalCenter">
      <i class="fa fa-plus"></i> New Sale
    </button>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newPurchaseInvoiceModalCenter">
      <i class="fa fa-plus"></i> New Purchase
    </button>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newPaymentModalCenter">
      <i class="fa fa-plus"></i> New Payment
    </button>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newReceiptModalCenter">
      <i class="fa fa-plus"></i> New Receipt
    </button>
    
	</div>
</div>

<div class="row clearfix mt-5">
    <div class="col-md-2">
        <div class="nav flex-column nav-pills">
          <a class="nav-link @if($tab_menu == 'user_show') active @endif" href="{{route ('users.show', ['user' => $user->id])}}">User Info</a>
          <a class="nav-link @if($tab_menu == 'reports') active @endif" href="{{route ('users.reports', ['id' => $user->id])}}">Reports</a>
          <a class="nav-link @if($tab_menu == 'sales') active @endif" href="{{route ('users.sales.invoices', ['id' => $user->id])}}">Sales</a>
          <a class="nav-link @if($tab_menu == 'purchases') active @endif" href="{{route ('users.purchases.invoices', ['id' => $user->id])}}">Purchases</a>
          <a class="nav-link @if($tab_menu == 'payments') active @endif" href="{{route ('users.payments', ['id' => $user->id])}}">Payments</a>
          <a class="nav-link @if($tab_menu == 'receipts') active @endif" href="{{route ('users.receipts', ['id' => $user->id])}}">Receipts</a>
        </div>
    </div>

    <div class="col-md-10">
        
       @yield('user_content')

    </div>
</div>


    <!-- Modal for adding user payments. -->
    <!-- Modal -->
    <div class="modal fade" id="newPaymentModalCenter" tabindex="-1" role="dialog" aria-labelledby="newPaymentModalCenterTitle" aria-hidden="true">
        {!! Form::open(['route' => ['users.payments.store', $user->id], 'method'=>'POST']) !!}
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newPaymentModalLongTitle">Add New Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                  <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label text-right">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::date('date',NULL, ['class'=>'form-control', 'id'=>'date', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label text-right">Amount <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('amount',NULL, ['class'=>'form-control', 'id'=>'amount', 'placeholder'=>'Amount', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="note" class="col-sm-3 col-form-label text-right">Note</label>
                    <div class="col-sm-9">
                      {{Form::textarea('note',NULL, ['class'=>'form-control', 'rows'=>'4', 'id'=>'note', 'placeholder'=>'Note'])}}
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
      {!! Form::close() !!}
    </div>


    <!-- Modal for adding user receipts. -->
    <!-- Modal -->
    <div class="modal fade" id="newReceiptModalCenter" tabindex="-1" role="dialog" aria-labelledby="newReceiptModalCenterTitle" aria-hidden="true">
        {!! Form::open(['route' => ['users.receipts.store', $user->id], 'method'=>'POST']) !!}
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newReceiptModalLongTitle">Add New Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                  <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label text-right">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::date('date',NULL, ['class'=>'form-control', 'id'=>'date', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label text-right">Amount <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('amount',NULL, ['class'=>'form-control', 'id'=>'amount', 'placeholder'=>'Amount', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="note" class="col-sm-3 col-form-label text-right">Note</label>
                    <div class="col-sm-9">
                      {{Form::textarea('note',NULL, ['class'=>'form-control', 'rows'=>'4', 'id'=>'note', 'placeholder'=>'Note'])}}
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
      {!! Form::close() !!}
    </div>


    <!-- Modal for adding user new sale invoice. -->
    <!-- Modal -->
    <div class="modal fade" id="newSaleInvoiceModalCenter" tabindex="-1" role="dialog" aria-labelledby="newSaleInvoiceModalCenterTitle" aria-hidden="true">
        {!! Form::open(['route' => ['users.sales.invoices.store', 'id'=>$user->id], 'method'=>'POST']) !!}
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newSaleInvoiceModalLongTitle">Add New Sale Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                  <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label text-right">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::date('date',NULL, ['class'=>'form-control', 'id'=>'date', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="challan_no" class="col-sm-3 col-form-label text-right">Challan Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('challan_no',NULL, ['class'=>'form-control', 'id'=>'challan_no', 'placeholder'=>'Challan Number', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="note" class="col-sm-3 col-form-label text-right">Note</label>
                    <div class="col-sm-9">
                      {{Form::textarea('note',NULL, ['class'=>'form-control', 'rows'=>'4', 'id'=>'note', 'placeholder'=>'Note'])}}
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
      {!! Form::close() !!}
    </div>

    <!-- Modal for adding user new purchase invoice. -->
    <!-- Modal -->
    <div class="modal fade" id="newPurchaseInvoiceModalCenter" tabindex="-1" role="dialog" aria-labelledby="newPurchaseInvoiceModalCenterTitle" aria-hidden="true">
        {!! Form::open(['route' => ['users.purchases.invoices.store', 'id'=>$user->id], 'method'=>'POST']) !!}
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newPurchaseInvoiceModalLongTitle">Add New Purchase Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                  <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label text-right">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::date('date',NULL, ['class'=>'form-control', 'id'=>'date', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="challan_no" class="col-sm-3 col-form-label text-right">Challan Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('challan_no',NULL, ['class'=>'form-control', 'id'=>'challan_no', 'placeholder'=>'Challan Number', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="note" class="col-sm-3 col-form-label text-right">Note</label>
                    <div class="col-sm-9">
                      {{Form::textarea('note',NULL, ['class'=>'form-control', 'rows'=>'4', 'id'=>'note', 'placeholder'=>'Note'])}}
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
      {!! Form::close() !!}
    </div>
@endsection