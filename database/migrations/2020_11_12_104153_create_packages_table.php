<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('falg')->nullable()->default('Popular');
            $table->string('status')->default('active');
            $table->string('home_page')->default('active');
            $table->string('background_color')->default('#e67e22');
            $table->string('image')->default('default.png');
            $table->double('price_egy_monthly', 8, 2)->nullable();
            $table->double('offer_egy_monthly', 8, 2)->nullable();
            $table->double('price_egy_yearly', 8, 2)->nullable();
            $table->double('offer_egy_yearly', 8, 2)->nullable();
            $table->double('price_dollar_monthly', 8, 2)->nullable();
            $table->double('offer_dollar_monthly', 8, 2)->nullable();
            $table->double('price_dollar_yearly', 8, 2)->nullable();
            $table->double('offer_dollar_yearly', 8, 2)->nullable();
            $table->string('time_period')->default('Monthly'); // once - Monthly - Yearly
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
        Schema::dropIfExists('packages');
    }
}
