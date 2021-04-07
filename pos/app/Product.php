<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'cost_price', 'price', 'has_stock', 'category_id'];

    public static function arrayForSelect()
    {
    	$products = Product::all();
    	$arr=[];
    	foreach($products as $product)
    	{
    		$arr[$product->id] = $product->title;
    	}
    	return $arr;
    }

    public function Category()
    {
    	return $this->belongsto(Category::class);
    }

    public function SaleItem()
    {
    	return $this->hasMany(SaleItem::class);
    }

    public function PurchaseItem()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
