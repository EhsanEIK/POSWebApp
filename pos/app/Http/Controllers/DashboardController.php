<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\SaleItem;
use App\PurchaseItem;
use App\Payment;
use App\Receipt;

class DashboardController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data['main_menu'] = 'Dashboard';
	}

    public function Index()
    {
    	$this->data['totalUsers'] 		= User::count('id');
    	$this->data['totalProducts'] 	= Product::count('id');
    	$this->data['totalSales'] 		= SaleItem::sum('total');
    	$this->data['totalPurchases'] 	= PurchaseItem::sum('total');
    	$this->data['totalPayments'] 	= Payment::sum('amount');
    	$this->data['totalReceipts'] 	= Receipt::sum('amount');
    	$this->data['totalStocks'] 		= PurchaseItem::sum('quantity') - SaleItem::sum('quantity');

    	return view('dashboard',$this->data);
    }
}
