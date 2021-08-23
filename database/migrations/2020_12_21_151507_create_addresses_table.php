<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->define('not_active');

            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->text('address');
            $table->text('title');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            $table->string('frirstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('phone')->nullable();

            $table->text('street')->nullable();
            $table->text('home_number')->nullable();
            $table->text('floor_number')->nullable();

            $table->text('postal_code')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();

            $table->text('customer_region')->nullable();
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('addresses');
    }
}
