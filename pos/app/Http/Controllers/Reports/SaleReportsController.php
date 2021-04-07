<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SaleItem;

class SaleReportsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Reports';
        $this->data['sub_menu'] = 'Sales';
    }
    
    public function Index(Request $request)
    {
    	$this->data['from_date'] = $request->get('from_date', date('Y-m-d'));
    	$this->data['to_date'] = $request->get('to_date', date('Y-m-d'));

    	$this->data['saleItems'] = SaleItem::select('sale_items.quantity', 
    								'sale_items.price', 'sale_items.total', 'sale_invoices.date', 'products.title')
    								->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
    								->join('products', 'sale_items.product_id', '=', 'products.id')
    								->whereBetween('sale_invoices.date', [$this->data['from_date'], $this->data['to_date']])
    								->get();

    	return view('reports.sales', $this->data); 
    }
}
