<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Receipt;

class ReceiptReportsController extends Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->data['main_menu'] = 'Reports';
        $this->data['sub_menu'] = 'Receipts';
    }

    public function Index(Request $request)
    {
    	$this->data['from_date'] = $request->get('from_date', date('Y-m-d'));
    	$this->data['to_date'] = $request->get('to_date', date('Y-m-d'));

    	$this->data['receipts'] = Receipt::whereBetween('date',
    								[$this->data['from_date'], $this->data['to_date']])
    								->get();

    	return view('reports.receipts', $this->data); 
    }
}
