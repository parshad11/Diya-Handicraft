<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id')->unsigned(0);
            $table->string('title');
            $table->integer('price');
            $table->integer('discount_price')->nullable();
            $table->string('shipping_method')->nullable();
            $table->integer('shipping_charge')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('brand')->nullable();
            $table->integer('quantity');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('rate')->default(5);
            $table->text('option')->nullable();
            $table->integer('order_item')->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt_description')->nullable();
            $table->string('image');
            $table->string('slug')->unique();
            $table->unsignedBiginteger('category_id')->unsigned();
            $table->boolean('feature')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('special')->default(0);
            $table->integer('views')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
