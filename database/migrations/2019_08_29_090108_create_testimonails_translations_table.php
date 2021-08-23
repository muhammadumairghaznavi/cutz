<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonailsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonails_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testimonails_id')->unsigned();
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('seo_key')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('locale')->index();
            $table->unique(['testimonails_id', 'locale']);
            $table->foreign('testimonails_id')->references('id')->on('testimonails')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonails_translations');
    }
}
