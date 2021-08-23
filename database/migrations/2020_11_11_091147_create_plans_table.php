<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();


            $table->string('status')->default('active');
            $table->string('home_page')->default('active');

            $table->string('image')->default('default.png');
            $table->double('price_egy', 8, 2)->nullable();
            $table->double('offer_egy', 8, 2)->nullable();
            $table->double('price_usd', 8, 2)->nullable();
            $table->double('offer_usd', 8, 2)->nullable();
            $table->string('time_period')->default('Monthly'); // once - monthly - yearly
            $table->string('background_color')->default('#FF6515');
            $table->text('link')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('plans');
    }
}
