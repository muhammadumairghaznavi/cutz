<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruction_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instruction_id')->unsigned();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('extra_description')->nullable();

            /////

            $table->text('ingredient')->nullable();
            ///
            $table->text('seo_key')->nullable();
            $table->text('seo_description')->nullable();


            $table->string('locale')->index();

            $table->unique(['instruction_id', 'locale']);
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruction_translations');
    }
}
