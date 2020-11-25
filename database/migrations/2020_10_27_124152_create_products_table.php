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
            $table->id();
            $table->string('ids');
            $table->string('name');
            $table->text('descriptionIntroduction');
            $table->text('descriptionFeatures');
            $table->integer('currentPrice');
            $table->integer('previousPrice');
            $table->string('image_1');
            $table->string('image_2');
            $table->string('image_3');
            $table->string('service');
            $table->string('category');
            $table->string('brand');
            $table->text('tags');
            $table->string('stock');
            $table->string('sizes');
            $table->string('colors');
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
