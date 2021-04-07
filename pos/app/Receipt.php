<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
	protected $fillable = ['amount', 'date', 'note', 'sale_invoice_id', 'user_id', 'admin_id'];
    
    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function SaleInvoice()
    {
        return $this->belongsTo(SaleInvoice::class);
    }
}
