<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_no');
            $table->integer('supplier_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('purchase_invoice_no')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer('item');
            $table->double('total_qty');
            $table->double('total_discount')->nullable();
            $table->double('total_tax')->nullable();
            $table->double('total_cost')->nullable();
            $table->double('order_tax_rate')->nullable();
            $table->double('order_tax')->nullable();
            $table->double('grand_total');
            $table->string('document')->nullable();
            $table->text('return_note')->nullable();
            $table->text('staff_note')->nullable();
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
        Schema::dropIfExists('purchase_returns');
    }
}
