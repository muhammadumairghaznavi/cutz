<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('parteners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('active');
            $table->string('home_page')->default('active');

            $table->string('image')->default('default.png');
            $table->string('link')->nullable();
            $table->integer('order')->default(0);

            $table->string('fb_link')->nullable();
            $table->string('tw_link')->nullable();
            $table->string('in_link')->nullable();
            $table->string('ln_link')->nullable();
            $table->string('yt_link')->nullable();
            $table->string('gh_link')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

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
        Schema::dropIfExists('parteners');
    }
}
