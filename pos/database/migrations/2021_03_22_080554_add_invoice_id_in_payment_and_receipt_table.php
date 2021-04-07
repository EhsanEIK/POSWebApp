<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceIdInPaymentAndReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->foreignId('sale_invoice_id')->nullable()->after('note');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('purchase_invoice_id')->nullable()->after('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn('sale_invoice_id');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('purchase_invoice_id');
        });
    }
}
