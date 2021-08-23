<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvenanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provenance_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provenance_id')->unsigned();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('extra_description')->nullable();
            $table->string('locale')->index();
            $table->unique(['provenance_id', 'locale']);
            $table->foreign('provenance_id')->references('id')->on('provenances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provenance_translations');
    }
}
