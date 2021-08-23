<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();

            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            $table->text('seo_key')->nullable();
            $table->text('seo_description')->nullable();


            $table->string('locale')->index();

            $table->unique(['service_id', 'locale']);
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_translations');
    }
}
