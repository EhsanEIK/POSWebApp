<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseItem;

class PurchaseReportsController extends Controller
{
	public function __construct()
    {
    	parent::__construct();
        $this->data['main_menu'] = 'Reports';
        $this->data['sub_menu'] = 'Purchases';
    }

    public function Index(Request $request)
    {
    	$this->data['from_date'] = $request->get('from_date', date('Y-m-d'));
		$this->data['to_date'] = $request->get('to_date', date('Y-m-d'));

		$this->data['purchaseItems'] = PurchaseItem::select('purchase_items.quantity', 
									'purchase_items.price', 'purchase_items.total', 'purchase_invoices.date', 'products.title')
									->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
									->join('products', 'purchase_items.product_id', '=', 'products.id')
									->whereBetween('purchase_invoices.date', [$this->data['from_date'], $this->data['to_date']])
									->get();

		return view('reports.purchases', $this->data); 
    }
}
