<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];

    public function Product()
    {
    	return $this->has(Product::class);
    }

    public static function arrayForSelect()
    {
    	$categories = Category::all();
    	$arr=[];
    	foreach($categories as $category)
    	{
    		$arr[$category->id] = $category->title;
    	}
    	return $arr;
    }
}
