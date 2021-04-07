<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payment;
use App\Http\Requests\PaymentAndReceiptRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserPaymentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['tab_menu'] = 'payments';
    }

    public function Index($id)
    {
    	$this->data['user'] = User::findorfail($id);

    	return view('users.payments.payments', $this->data);
    }

    public function Store(PaymentAndReceiptRequest $request, $user_id, $invoice_id = null)
    {
    	$formData = $request->all();
    	$formData['user_id'] = $user_id;
    	$formData['admin_id'] = Auth::id();
        if ($invoice_id)
        {
            $formData['purchase_invoice_id'] = $invoice_id;
        }
        if(Payment::Create($formData))
        {
            Session::flash('strong', 'Success!');
            Session::flash('message', 'Payment Added Successfully!');
        }
        if($invoice_id)
        {
            return redirect()->route('users.purchases.invoices.items', ['id' => $user_id, 'invoice_id' => $invoice_id]);
        }
        else
        {
            return redirect()->route('users.show', ['user' => $user_id]);
        }
    }

    public function Destroy($user_id, $payment_id)
    {
        if(Payment::Destroy($payment_id))
        {
            Session::flash('strong', 'Delete!');
            Session::flash('message', 'Payment Deleted Successfully!');
        }
        return redirect()->route('users.payments', ['id' => $user_id]);
    }
}
