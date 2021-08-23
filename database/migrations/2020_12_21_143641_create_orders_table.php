<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_type')->default('desktop');

            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->string('type_delivery')->nullable();
            $table->string('employees')->nullable();

            $table->integer('total')->nullable();
            $table->string('status')->default('pendding'); // pendding,inShipment,onDelivery,completed,canceled,completed

            $table->string('shipping_number')->nullable(); // Shipping number
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_country')->nullable();
            $table->text('customer_region')->nullable();
            $table->text('customer_street')->nullable();
            $table->text('customer_home_number')->nullable();
            $table->text('customer_floor_number')->nullable();
            $table->text('customer_appartment_number')->nullable();
            $table->string('customer_postal_code')->nullable();
            $table->text('customer_comments_extra')->nullable();
            $table->double('langtude', 8, 2)->default(0.0);
            $table->double('lattude', 8, 2)->default(0.0);

            $table->string('payment_method')->default('visa');
            $table->string('payment_status')->default('Not Complete'); // done paied =1 or not = 0

            $table->double('taxes')->nullable();
            $table->double('delivery_fees')->nullable();
            $table->string('promocode')->nullable();


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
        Schema::dropIfExists('orders');
    }
}
