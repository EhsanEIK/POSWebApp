<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PurchaseItem;
use App\Receipt;
use App\SaleItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class UserReportsController extends Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->data['tab_menu'] = 'reports';
    }

    public function Reports($id)
    {
    	$this->data['user'] = User::findorfail($id);
    	
    	$this->data['saleItems'] = SaleItem::select('products.title', DB::raw('SUM(sale_items.quantity) AS quantity, AVG(sale_items.price) AS price, SUM(sale_items.total) AS total'))
    								->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
    								->join('products', 'sale_items.product_id', '=', 'products.id')
    								->where('products.has_stock',1)
    								->where('sale_invoices.user_id',$id)
    								->groupBy('products.id')
    								->get();

    	$this->data['purchaseItems'] = PurchaseItem::select(DB::raw('SUM(purchase_items.quantity) AS quantity, AVG(purchase_items.price) AS price, SUM(purchase_items.total) AS total'), 'products.title')
									->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
									->join('products', 'purchase_items.product_id', '=', 'products.id')
									->where('products.has_stock',1)
									->where('purchase_invoices.user_id',$id)
									->groupBy('products.id')
									->get();

		$this->data['payments'] = Payment::select('date', DB::raw('SUM(amount) AS amount'))
									->groupBy('date')
									->where('user_id',$id)
    								->get();

    	$this->data['receipts'] = Receipt::select('date', DB::raw('SUM(amount) AS amount'))
    								->groupBy('date')
    								->where('user_id',$id)
    								->get();

    	return view('users.reports.reports', $this->data);
    }


    public function PDFDownload($id)
    {
        $this->data['user'] = User::findorfail($id);
        
        $this->data['saleItems'] = SaleItem::select('products.title', DB::raw('SUM(sale_items.quantity) AS quantity, AVG(sale_items.price) AS price, SUM(sale_items.total) AS total'))
                                    ->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
                                    ->join('products', 'sale_items.product_id', '=', 'products.id')
                                    ->where('products.has_stock',1)
                                    ->where('sale_invoices.user_id',$id)
                                    ->groupBy('products.id')
                                    ->get();

        $this->data['purchaseItems'] = PurchaseItem::select(DB::raw('SUM(purchase_items.quantity) AS quantity, AVG(purchase_items.price) AS price, SUM(purchase_items.total) AS total'), 'products.title')
                                    ->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
                                    ->join('products', 'purchase_items.product_id', '=', 'products.id')
                                    ->where('products.has_stock',1)
                                    ->where('purchase_invoices.user_id',$id)
                                    ->groupBy('products.id')
                                    ->get();

        $this->data['payments'] = Payment::select('date', DB::raw('SUM(amount) AS amount'))
                                    ->groupBy('date')
                                    ->where('user_id',$id)
                                    ->get();

        $this->data['receipts'] = Receipt::select('date', DB::raw('SUM(amount) AS amount'))
                                    ->groupBy('date')
                                    ->where('user_id',$id)
                                    ->get();

        $pdf = PDF::loadView('pdf.reportsPDF', $this->data);
        return $pdf->stream('reports.pdf');
    }
}
