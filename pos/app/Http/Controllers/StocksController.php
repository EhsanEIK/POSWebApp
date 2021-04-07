<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class StocksController extends Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Products';
        $this->data['sub_menu'] = 'Stocks';
    }

    public function Index()
    {
    	$this->data['products'] 	 = Product::where('has_stock', 1)->get();

    	return view('products.stocks', $this->data);
    }
}
