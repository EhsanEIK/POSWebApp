<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceItemRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PurchaseInvoice;
use App\PurchaseItem;
use App\Product;

class UserPurchasesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['tab_menu'] = 'purchases';
    }

    public function Index($id)
    {
    	$this->data['user'] = User::findorfail($id);

    	return view('users.purchases.purchases', $this->data);
    }

    public function InvoiceStore(InvoiceRequest $request,$user_id)
    {
    	$formData = $request->all();
    	$formData['user_id'] 	= $user_id;
    	$formData['admin_id'] 	= Auth::id();
    	if($invoice = PurchaseInvoice::create($formData))
    	{
    		Session::flash('strong', 'Success!');
            Session::flash('message', 'Purchase Invoice Added Successfully!');
    	}

    	return redirect()->route('users.purchases.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice->id]);
    }

    public function InvoiceDestroy($user_id, $invoice_id)
    {
    	if(PurchaseInvoice::destroy($invoice_id))
    	{
    		Session::flash('strong', 'Delete!');
            Session::flash('message', 'Purchase Invoice Deleted Successfully!');
    	}

    	return redirect()->route('users.purchases.invoices', ['id' => $user_id]);
    }

    public function ItemShow($user_id, $invoice_id)
    {
    	$this->data['user'] 		= User::findOrFail($user_id);
    	$this->data['invoice']  	= PurchaseInvoice::findOrFail($invoice_id);
    	$this->data['products'] 	= Product::arrayForSelect();

    	$this->data['totalAmount'] 	= $this->data['invoice']->PurchaseItem()->sum('total');
    	$this->data['totalPaid'] 	= $this->data['invoice']->Payment()->sum('amount');
    	$this->data['due'] 			= $this->data['totalAmount'] - $this->data['totalPaid'];  	

    	return view('users.purchases.invoices', $this->data); 
    }

    public function ItemStore(InvoiceItemRequest $request, $user_id, $invoice_id)
    {
    	$formData 					 = $request->all();
    	$formData['purchase_invoice_id'] = $invoice_id;
    	if(PurchaseItem::create($formData))
    	{
    		Session::flash('strong', 'Success!');
            Session::flash('message', 'Purchase Item Added Successfully!');
    	}  	

    	return redirect()->route('users.purchases.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice_id]);
    }

    public function ItemDestroy($user_id, $invoice_id, $item_id)
    {
    	if(PurchaseItem::destroy($item_id))
    	{
    		Session::flash('strong', 'Delete!');
            Session::flash('message', 'Purchase Item Deleted Successfully!');
    	}  	

    	return redirect()->route('users.purchases.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice_id]);
    }
}
