<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartenersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parteners_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parteners_id')->unsigned();

            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
           
            $table->text('seo_key')->nullable();
            $table->text('seo_description')->nullable();
            
            
            $table->string('locale')->index();

            $table->unique(['parteners_id', 'locale']);
            $table->foreign('parteners_id')->references('id')->on('parteners')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parteners_translations');
    }
}
