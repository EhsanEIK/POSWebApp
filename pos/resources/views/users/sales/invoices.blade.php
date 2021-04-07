@extends('users.sales.invoice_layout')

@section('title','Show User Sale Items')


@section('invoice_add_button')
    <button class="btn btn-success" data-toggle="modal" data-target="#newSaleItemModalCenter"><i class="fa fa-plus"></i> Add Item</button>

    <button class="btn btn-primary" data-toggle="modal" data-target="#newReceiptForSaleInvoiceModalCenter"><i class="fa fa-plus"></i> Add Receipt</button>
@endsection


@section('user_content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-header py-3">
            <div class="row clearfix">
                <div class="col-md-4">
                    <h6 class="m-0 font-weight-bold text-primary"><strong>Sale Items</strong> Information</h6>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div><strong>Name: </strong>{{$user->name}}</div>
                    <div><strong>E-mail: </strong>{{$user->email}}</div>
                    <div><strong>Phone: </strong>{{$user->phone}}</div>
                </div>
                <div class="col-md-6 text-right">
                    <div><strong>Date: </strong>{{$invoice->date}}</div>
                    <div><strong>Challan No.: </strong>{{$invoice->challan_no}}</div>
                </div>
            </div>

            <hr>
            <div class="sale_invoice_items mt-3">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <th>SL No.</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Action</th>                        
                    </thead>
                    <tbody>
                        @foreach($invoice->SaleItem as $key => $saleItem)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$saleItem->product->title}}</td>
                            <td>{{$saleItem->price}}</td>
                            <td>{{$saleItem->quantity}}</td>
                            <td class="text-right">{{$saleItem->total}}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route ( 'users.sales.invoices.items.destroy', ['id'=>$user->id, 'invoice_id'=>$invoice->id, 'item_id'=>$saleItem->id] )}}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th colspan="4" class="text-right">Total: </th>
                        <th class="text-right">{{ $totalAmount}}</th>
                        <th></th>                       
                    </tr>

                    <tr>
                        <th colspan="4" class="text-right">Paid: </th>
                        <th class="text-right">{{ $totalPaid}}</th>
                        <th></th>                       
                    </tr>

                    <tr>
                        <th colspan="4" class="text-right">Due: </th>
                        <th class="text-right">{{ $due}}</th>
                        <th></th>                       
                    </tr>
                </table>
            </div> 
        </div>
    </div>

    <!-- Modal for adding user sale ITEM. -->
    <!-- Modal -->
    <div class="modal fade" id="newSaleItemModalCenter" tabindex="-1" role="dialog" aria-labelledby="newSaleItemModalCenterTitle" aria-hidden="true">
        {!! Form::open(['route' => ['users.sales.invoices.items.store', 'id'=>$user->id, 'invoice_id'=> $invoice->id], 'method'=>'POST']) !!}
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newSaleItemModalLongTitle">Add New Item
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                  <div class="form-group row">
                    <label for="product_id" class="col-sm-3 col-form-label text-right">Product <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::select('product_id', $products, NULL, ['class'=>'form-control', 'id'=>'product_id', 'placeholder' => 'SELECT', 'required'])}}
                    </div>
                  </div>  

                  <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label text-right">Unite Price <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('price',NULL, ['class'=>'form-control', 'id'=>'price', 'onkeyup'=>'getTotal()','placeholder'=>'Unite Price', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="quantity" class="col-sm-3 col-form-label text-right">Quantity <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      {{Form::text('quantity',NULL, ['class'=>'form-control', 'id'=>'quantity', 'onkeyup'=>'getTotal()', 'placeholder'=>'Quantity', 'required'])}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="total" class="col-sm-3 col-form-label text-right">Total</label>
                    <div class="col-sm-9">
                      {{Form::text('total',NULL, ['class'=>'form-control', 'id'=>'total', 'placeholder'=>'Total', 'readonly'=>'true'])}}
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

    <!-- Modal for adding user new RECEIPT for sale invoice. -->
    <!-- Modal -->
    <div class="modal fade" id="newReceiptForSaleInvoiceModalCenter" tabindex="-1" role="dialog" aria-labelledby="newReceiptForSaleInvoiceModalCenterTitle" aria-hidden="true">
        {!! Form::open(['route' => ['users.receipts.store', 'id'=>$user->id, 'invoice_id'=>$invoice->id], 'method'=>'POST']) !!}
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newReceiptForSaleInvoiceModalLongTitle">Add New Receipt For This Invoice</h5>
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



    <script type="text/javascript">
      function getTotal()
      {
        var price     = document.getElementById('price').value;
        var quantity  = document.getElementById('quantity').value;
        if(price && quantity)
        {
          var total = price*quantity;
          document.getElementById('total').value = total;
        }
      }
    </script>
    
@endsection