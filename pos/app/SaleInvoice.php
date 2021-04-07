<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
	protected $fillable = ['date', 'challan_no', 'note', 'admin_id', 'user_id'];

    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public function Admin()
    {
    	return $this->belongsTo(Admin::class);
    }

    public function SaleItem()
    {
    	return $this->hasMany(SaleItem::class);
    }

    public function Receipt()
    {
        return $this->hasMany(Receipt::class);
    }
}
