<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['name','email','phone','address','group_id'];

    public function Group()
    {
    	return $this->belongsTo(Group::class);
    }

    public function SaleInvoice()
    {
    	return $this->hasMany(SaleInvoice::class);
    }

    public function PurchaseInvoice()
    {
    	return $this->hasMany(PurchaseInvoice::class);
    }

    public function Payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function Receipt()
    {
        return $this->hasMany(Receipt::class);
    }
}
