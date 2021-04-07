<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceItemRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SaleInvoice;
use App\SaleItem;
use App\Product;

class UserSalesController extends Controller
{
	public function __construct()
    {
        parent::__construct();
    	$this->data['tab_menu'] = 'sales';
    }

    public function Index($id)
    {
    	$this->data['user'] = User::findorfail($id);

    	return view('users.sales.sales', $this->data);
    }

    public function InvoiceStore(InvoiceRequest $request,$user_id)
    {
    	$formData = $request->all();
    	$formData['user_id'] = $user_id;
    	$formData['admin_id'] = Auth::id();
    	if($invoice = SaleInvoice::create($formData))
    	{
    		Session::flash('strong', 'Success!');
            Session::flash('message', 'Sale Invoice Added Successfully!');
    	}  	

    	return redirect()->route('users.sales.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice->id]);
    }

    public function InvoiceDestroy($user_id, $invoice_id)
    {
    	if(SaleInvoice::destroy($invoice_id))
    	{
    		Session::flash('strong', 'Delete!');
            Session::flash('message', 'Sale Invoice Deleted Successfully!');
    	}  	

    	return redirect()->route('users.sales.invoices', ['id' => $user_id]);
    }

    public function ItemShow($user_id, $invoice_id)
    {
    	$this->data['user'] 		= User::findOrFail($user_id);
    	$this->data['invoice']  	= SaleInvoice::findOrFail($invoice_id);
    	$this->data['products'] 	= Product::arrayForSelect();

        $this->data['totalAmount']  = $this->data['invoice']->SaleItem()->sum('total');
        $this->data['totalPaid']    = $this->data['invoice']->Receipt()->sum('amount');    
        $this->data['due']          = $this->data['totalAmount'] - $this->data['totalPaid'] ;

    	return view('users.sales.invoices', $this->data); 
    }

    public function ItemStore(InvoiceItemRequest $request,$user_id, $invoice_id)
    {
    	$formData 					 = $request->all();
    	$formData['sale_invoice_id'] = $invoice_id;
    	if(SaleItem::create($formData))
    	{
    		Session::flash('strong', 'Success!');
            Session::flash('message', 'Sale Item Added Successfully!');
    	}  	

    	return redirect()->route('users.sales.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice_id]);
    }

    public function ItemDestroy($user_id, $invoice_id, $item_id)
    {
    	if(SaleItem::destroy($item_id))
    	{
    		Session::flash('strong', 'Delete!');
            Session::flash('message', 'Sale Item Deleted Successfully!');
    	}  	

    	return redirect()->route('users.sales.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice_id]);
    }
    
}
