<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//for Login
Route::get('login','Auth\LoginController@Login')->name('login');
Route::post('login','Auth\LoginController@Authenticate')->name('login.confirm');


//Middleware for admin authentication
Route::middleware('auth')->group(function(){

	Route::get('/', function () {
    	return view('dashboard');
	});

	//for Dashboard
	Route::get('dashboard', 'DashboardController@Index')->name('dashboard');

	//for Logout
	Route::get('logout', 'Auth\LoginController@Logout')->name('logout');

	//for Group model
	Route::get('groups', 'UserGroupsController@Index')->name('groups');
	Route::get('groups/create', 'UserGroupsController@Create')->name('groups.create');
	Route::post('groups', 'UserGroupsController@Store')->name('groups.store');
	Route::get('groups/{id}/edit', 'UserGroupsController@Edit')->name('groups.edit');
	Route::put('groups/{id}', 'UserGroupsController@Update')->name('groups.update');
	Route::delete('groups/{id}', 'UserGroupsController@Destroy')->name('groups.destroy');

	//for User model
	Route::resource('users','UsersController');


	//for User  Sales model (Sale Invoice)
	Route::get('users/{id}/sales/invoices', 'UserSalesController@Index' )->name('users.sales.invoices');
	Route::post('users/{id}/sales/invoices', 'UserSalesController@InvoiceStore' )->name('users.sales.invoices.store');
	Route::delete('users/{id}/sales/invoices/{invoice_id}', 'UserSalesController@InvoiceDestroy' )->name('users.sales.invoices.destroy');

	//for User  Sales model (Sale Item)
	Route::get('users/{id}/sales/invoices/{invoice_id}/items', 'UserSalesController@ItemShow' )->name('users.sales.invoices.items');
	Route::post('users/{id}/sales/invoices/{invoice_id}/items', 'UserSalesController@ItemStore' )->name('users.sales.invoices.items.store');
	Route::delete('users/{id}/sales/invoices/{invoice_id}/items/{item_id}', 'UserSalesController@ItemDestroy' )->name('users.sales.invoices.items.destroy');


	//for User Purchases model (Purchase Invoice)
	Route::get('users/{id}/purchases/invoices', 'UserPurchasesController@Index' )->name('users.purchases.invoices');
	Route::post('users/{id}/purchases/invoices', 'UserPurchasesController@InvoiceStore' )->name('users.purchases.invoices.store');
	Route::delete('users/{id}/purchases/invoices/{invoice_id}', 'UserPurchasesController@InvoiceDestroy' )->name('users.purchases.invoices.destroy');

	//for User  Purchases model (Purchase Item)
	Route::get('users/{id}/purchases/invoices/{invoice_id}/items', 'UserPurchasesController@ItemShow' )->name('users.purchases.invoices.items');
	Route::post('users/{id}/purchases/invoices/{invoice_id}/items', 'UserPurchasesController@ItemStore' )->name('users.purchases.invoices.items.store');
	Route::delete('users/{id}/purchases/invoices/{invoice_id}/items/{item_id}', 'UserPurchasesController@ItemDestroy' )->name('users.purchases.invoices.items.destroy');



	//for User Payments model
	Route::get('users/{id}/payments', 'UserPaymentsController@Index' )->name('users.payments');
	Route::post('users/{id}/payments/{invoice_id?}', 'UserPaymentsController@Store' )->name('users.payments.store');
	Route::delete('users/{id}/payments/{payment_id}', 'UserPaymentsController@Destroy' )->name('users.payments.destroy');

	//for User Receipts model
	Route::get('users/{id}/receipts', 'UserReceiptsController@Index' )->name('users.receipts');
	Route::post('users/{id}/receipts/{invoice_id?}', 'UserReceiptsController@Store' )->name('users.receipts.store');
	Route::delete('users/{id}/receipts/{receipt_id}', 'UserReceiptsController@Destroy' )->name('users.receipts.destroy');

	//for User Reports
	Route::get('users/{id}/reports', 'UserReportsController@Reports' )->name('users.reports');

	//for User Reports PDF
	Route::get('users/{id}/reports/PDF', 'UserReportsController@PDFDownload' )->name('users.reports.pdfDownload');



	//for Category model
	Route::resource('categories','CategoriesController', ['except'=>['show']]);

	//for Products model
	Route::resource('products','ProductsController');

	//for showing Stock
	Route::get('stocks', 'StocksController@Index')->name('stocks');


	//for showing Reports
	Route::get('reports/sales', 'Reports\SaleReportsController@Index')->name('reports.sales');
	Route::get('reports/purchases', 'Reports\PurchaseReportsController@Index')->name('reports.purchases');
	Route::get('reports/payments', 'Reports\PaymentReportsController@Index')->name('reports.payments');
	Route::get('reports/receipts', 'Reports\ReceiptReportsController@Index')->name('reports.receipts');

	Route::get('reports/day_reports', 'Reports\DayReportsController@Index')->name('reports.day_reports');

	//for Day Reports PDF
	Route::get('reports/day_reports/pdf', 'Reports\DayReportsController@PDFDownload')->name('reports.day_reports.pdf');


});



