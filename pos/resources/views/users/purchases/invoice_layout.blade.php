@extends('layout.main')

@section('title')

@section('content')

<div class="row clearfix page-header">
  <div class="col-md-2">
      <a class="btn btn-info" href="{{ route ('users.purchases.invoices', ['id'=>$user->id])}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
  </div>

  <div class="col-md-10 text-right">
    @yield('invoice_add_button')
  </div>

</div>

<div class="row clearfix mt-5">
    <div class="col-md-2">
        <div class="nav flex-column nav-pills">
          <a class="nav-link @if($tab_menu == 'user_show') active @endif" href="{{route ('users.show', ['user' => $user->id])}}">User Info</a>
          <a class="nav-link @if($tab_menu == 'sales') active @endif" href="{{route ('users.sales.invoices', ['id' => $user->id])}}">Sales</a>
          <a class="nav-link @if($tab_menu == 'purchases') active @endif" href="{{route ('users.purchases.invoices.items', ['id' => $user->id, 'invoice_id'=>$invoice->id])}}">Purchase Items</a>
          <a class="nav-link @if($tab_menu == 'payments') active @endif" href="{{route ('users.payments', ['id' => $user->id])}}">Payments</a>
          <a class="nav-link @if($tab_menu == 'receipts') active @endif" href="{{route ('users.receipts', ['id' => $user->id])}}">Receipts</a>
        </div>
    </div>

    <div class="col-md-10">
        
       @yield('user_content')

    </div>
</div>

@endsection