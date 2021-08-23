<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blogs_id')->unsigned();

            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            $table->text('seo_key')->nullable();
            $table->text('seo_description')->nullable();


            $table->string('locale')->index();

            $table->unique(['blogs_id', 'locale']);
            $table->foreign('blogs_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs_translations');
    }
}
