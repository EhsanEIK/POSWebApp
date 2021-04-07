<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
	protected $fillable = ['product_id', 'sale_invoice_id', 'quantity', 'price', 'total'];

    public function SaleInvoice()
    {
    	return $this->belongsTo(SaleInvoice::class);
    }

    public function Product()
    {
    	return $this->belongsto(Product::class);
    }
}
