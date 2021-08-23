<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');


            $table->string('customer_country')->default('egy'); //egy - usd

            $table->string('invoice_number', 50)->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();

            $table->integer('package_id')->unsigned()->nullable();  // app package
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');



            $table->integer('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->text('title_service_details')->nullable();


            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            ////

            $table->decimal('item_price', 8, 2)->nullable();
            $table->decimal('total', 8, 2)->nullable();

            $table->decimal('discount', 8, 2)->nullable();
            $table->string('coupon_code')->nullable();

            $table->double('fees')->nullable();
            $table->decimal('vat', 8, 2)->nullable();


            ///
            $table->string('payment_type')->default('monthly');  //monthly  -  yearly
            $table->string('payment_method')->default('cach');
            $table->string('payment_status')->default('Not completed'); //done paied =1 or not = 0
            ///

            $table->text('note')->nullable();
            $table->string('status', 50)->default('pending');
            ////
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
