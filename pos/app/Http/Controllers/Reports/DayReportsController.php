<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Payment;
use App\PurchaseItem;
use App\Receipt;
use App\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DayReportsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Reports';
        $this->data['sub_menu'] = 'day_reports';
    }
    
    public function Index(Request $request)
    {
    	// $this->data['from_date'] = $request->get('from_date', date('Y-m-d'));
    	// $this->data['to_date'] = $request->get('to_date', date('Y-m-d'));

        $this->data['from_date'] = date('Y-m-d');
        $this->data['to_date'] = date('Y-m-d');

    	$this->data['saleItems'] = SaleItem::select('products.title', DB::raw('SUM(sale_items.quantity) AS quantity, AVG(sale_items.price) AS price, SUM(sale_items.total) AS total'))
    								->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
    								->join('products', 'sale_items.product_id', '=', 'products.id')
    								->whereBetween('sale_invoices.date', [$this->data['from_date'], $this->data['to_date']])
    								->where('products.has_stock',1)
    								->groupBy('products.id')
    								->get();

    	$this->data['purchaseItems'] = PurchaseItem::select(DB::raw('SUM(purchase_items.quantity) AS quantity, AVG(purchase_items.price) AS price, SUM(purchase_items.total) AS total'), 'products.title')
									->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
									->join('products', 'purchase_items.product_id', '=', 'products.id')
									->whereBetween('purchase_invoices.date', [$this->data['from_date'], $this->data['to_date']])
									->where('products.has_stock',1)
									->groupBy('products.id')
									->get();

		$this->data['payments'] = Payment::select('users.name','users.phone', DB::raw('SUM(payments.amount) AS amount'))
									->join('users', 'payments.user_id','=','users.id')
									->whereBetween('date', [$this->data['from_date'], $this->data['to_date']])
									->groupBy('users.id')
    								->get();

    	$this->data['receipts'] = Receipt::select('users.name','users.phone', DB::raw('SUM(receipts.amount) AS amount'))
							    	->join('users', 'receipts.user_id','=','users.id')
    								->whereBetween('date',[$this->data['from_date'], $this->data['to_date']])
    								->groupBy('users.id')
    								->get();

    	return view('reports.day_reports', $this->data); 
    }


    public function PDFDownload(Request $request)
    {

        $this->data['from_date'] = date('Y-m-d');
        $this->data['to_date'] = date('Y-m-d');

        $this->data['saleItems'] = SaleItem::select('products.title', DB::raw('SUM(sale_items.quantity) AS quantity, AVG(sale_items.price) AS price, SUM(sale_items.total) AS total'))
                                    ->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
                                    ->join('products', 'sale_items.product_id', '=', 'products.id')
                                    ->whereBetween('sale_invoices.date', [$this->data['from_date'], $this->data['to_date']])
                                    ->where('products.has_stock',1)
                                    ->groupBy('products.id')
                                    ->get();

        $this->data['purchaseItems'] = PurchaseItem::select(DB::raw('SUM(purchase_items.quantity) AS quantity, AVG(purchase_items.price) AS price, SUM(purchase_items.total) AS total'), 'products.title')
                                    ->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
                                    ->join('products', 'purchase_items.product_id', '=', 'products.id')
                                    ->whereBetween('purchase_invoices.date', [$this->data['from_date'], $this->data['to_date']])
                                    ->where('products.has_stock',1)
                                    ->groupBy('products.id')
                                    ->get();

        $this->data['payments'] = Payment::select('users.name','users.phone', DB::raw('SUM(payments.amount) AS amount'))
                                    ->join('users', 'payments.user_id','=','users.id')
                                    ->whereBetween('date', [$this->data['from_date'], $this->data['to_date']])
                                    ->groupBy('users.id')
                                    ->get();

        $this->data['receipts'] = Receipt::select('users.name','users.phone', DB::raw('SUM(receipts.amount) AS amount'))
                                    ->join('users', 'receipts.user_id','=','users.id')
                                    ->whereBetween('date',[$this->data['from_date'], $this->data['to_date']])
                                    ->groupBy('users.id')
                                    ->get();

        $pdf = PDF::loadView('pdf.day_reports_pdf', $this->data);
        return $pdf->stream('day_reports.pdf');
    }
}
