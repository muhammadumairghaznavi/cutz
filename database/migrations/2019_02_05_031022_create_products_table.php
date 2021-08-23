<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');


            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('subCategory_id')->unsigned();
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->double('price', 8, 2)->unsigned()->default(0);
            $table->double('discount', 8, 2)->unsigned()->nullable();

            $table->integer('stock')->nullable()->default(0);
            $table->integer('stock_limit_alert')->nullable()->default(0);
            $table->integer('count_solid')->nullable()->default(0);

            $table->integer('number_views')->nullable()->default(0);
            $table->integer('number_clicks')->nullable()->default(0);

            ////
            $table->string('provenance_id')->nullable();
            ///
            $table->string('country')->nullable()->default('Ausralia');
            $table->string('falg')->nullable()->default('no'); // contain BBQ or not
            ///
            $table->string('panSearing')->nullable()->default('no');
            $table->string('chilies')->nullable()->default('no');
            $table->string('frozen')->nullable()->default('no');
            $table->string('hermonFree')->nullable()->default('yes');
            $table->string('roasting')->nullable()->default('no');
            $table->string('expiration')->nullable();


            ///

            $table->string('image_flag')->default('default.png');
            $table->string('image')->default('default.png');

            $table->string('featured')->default('not_active');
            $table->string('trending')->default('not_active');
            $table->string('best_seller')->default('not_active');
            $table->string('spicail_pag')->default('active');
            $table->string('home_page')->default('active');
            $table->string('status')->default('active');
            $table->string('background_color')->default('#e67e22');

            //
            $table->string('measr_unit')->default('per_unit');  //per_unit  or  weight
            $table->integer('unitValue')->default(1);  // set value if measr_unit ==per_unit else set value =1
            ///

            $table->text('ifram')->nullable();
            $table->text('link')->nullable();
            $table->string('sku')->nullable();
            $table->integer('serve_number')->nullable()->default(1);


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
        Schema::dropIfExists('products');
    }
}
