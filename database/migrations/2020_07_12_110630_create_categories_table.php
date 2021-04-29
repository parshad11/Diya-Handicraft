<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->integer('parent_id')->default(0);
            $table->boolean('child')->default(0);
            $table->integer('order_no')->default(0);
            $table->text('description')->nullable();
            $table->integer('display_type')->default(0);
            $table->boolean('default_categories')->default(0);
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('feature')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
