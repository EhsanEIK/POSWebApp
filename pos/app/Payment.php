<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $fillable = ['date', 'amount', 'note', 'purchase_invoice_id', 'user_id', 'admin_id'];
	
    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function PurchaseInvoice()
    {
        return $this->belongsTo(PurchaseInvoice::class);
    }
}
