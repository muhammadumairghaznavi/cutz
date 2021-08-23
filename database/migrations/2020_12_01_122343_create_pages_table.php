<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->text('link')->nullable();
            $table->string('image')->default('default.png');
            $table->string('num1')->nullable();
            $table->string('num2')->nullable();
            $table->string('email')->nullable();
            $table->string('num3')->nullable();
            $table->text('map')->nullable();
            $table->text('seo_google_analatic')->nullable();
            $table->text('facebook_messanger')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
