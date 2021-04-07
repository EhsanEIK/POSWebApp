<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = ['product_id', 'purchase_invoice_id', 'quantity', 'price', 'total'];

    public function PurchaseInvoice()
    {
    	return $this->belongsTo(PurchaseInvoice::class);
    }
    
    public function Product()
    {
    	return $this->belongsto(Product::class);
    }
}
