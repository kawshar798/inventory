<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->integer('customer_id');
            $table->integer('warehouse_id')->nullable();
            $table->integer('biller_id');
            $table->integer('item');
            $table->integer('total_qty');
            $table->double('total_discount',10,2);
            $table->double('total_tax',10,2);
            $table->double('total_price',10,2);
            $table->double('grand_total',10,2);
            $table->double('coupon_discount')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->string('payment_status');
            $table->string('document')->nullable();
            $table->double('paid_amount',10,2)->nullable();
            $table->double('due_amount',10,2)->nullable();
            $table->double('return_amount',10,2)->nullable();
            $table->text('sale_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
