<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('verified')->default(false);
            $table->string('full_name')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('social_id')->nullable();
            $table->string('deviceType')->nullable();
            $table->text('firebaseToken')->nullable();
            $table->string('term_condition')->default('0'); //not accept term_condition
            $table->string('status')->default('1'); // Active
            $table->string('gender')->nullable();
            $table->string('image')->default('default.png');
            $table->string('approved')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            // used for  social login
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('customer_address')->nullable();
            $table->text('customer_region')->nullable();
            $table->text('customer_street')->nullable();
            $table->text('customer_home_number')->nullable();
            $table->text('customer_floor_number')->nullable();
            $table->text('customer_appartment_number')->nullable();
            $table->string('customer_postal_code')->nullable();
            $table->text('customer_comments_extra')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('vendors');
    }
}
