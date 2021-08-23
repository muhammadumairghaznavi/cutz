<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTestimonailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('active');
            $table->string('home_page')->default('active');

            $table->string('image')->default('default.png');
            $table->string('image2')->default('default.png');
            $table->integer('type')->default(1);//1 about us  2 vision  3 mission
            $table->text('link')->nullable();
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
        Schema::dropIfExists('testimonails');
    }
}
