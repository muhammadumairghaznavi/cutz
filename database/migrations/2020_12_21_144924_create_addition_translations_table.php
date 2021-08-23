<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addition_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('addition_id')->unsigned();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('extra_description')->nullable();

            $table->string('locale')->index();

            $table->unique(['addition_id', 'locale']);
            $table->foreign('addition_id')->references('id')->on('additions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addition_translations');
    }
}
