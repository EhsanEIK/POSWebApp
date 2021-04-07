<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
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

    public function PurchaseItem()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function Payment()
    {
        return $this->hasMany(Payment::class);
    }
}
