<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Receipt;
use App\Http\Requests\PaymentAndReceiptRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserReceiptsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['tab_menu'] = 'receipts';
    }

    public function Index($id)
    {
    	$this->data['user'] = User::findorfail($id);

    	return view('users.receipts.receipts', $this->data);
    }

    public function Store(PaymentAndReceiptRequest $request, $user_id, $invoice_id= null)
    {
    	$formData 			  = $request->all();
    	$formData['user_id']  = $user_id;
    	$formData['admin_id'] = Auth::id();
        if ($invoice_id)
        {
            $formData['sale_invoice_id'] = $invoice_id;
        }
        if(Receipt::Create($formData))
        {
            Session::flash('strong', 'Success!');
            Session::flash('message', 'Receipt Added Successfully!');
        }

        if($invoice_id)
        {
            return redirect()->route('users.sales.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice_id]);
        }
        else
        {
            return redirect()->route('users.show', ['user' => $user_id]);
        }
        
    }

    public function Destroy($user_id, $receipt_id)
    {
        if(Receipt::Destroy($receipt_id))
        {
            Session::flash('strong', 'Delete!');
            Session::flash('message', 'Receipt Deleted Successfully!');
        }
        return redirect()->route('users.receipts', ['id' => $user_id]);
    }
}
