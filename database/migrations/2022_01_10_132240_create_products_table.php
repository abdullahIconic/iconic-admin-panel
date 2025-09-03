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
            $table->boolean('visible')->default(1);
            $table->boolean('highlighted')->default(0);

            $table->foreignId('brand_id');
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id')->nullable();

            $table->bigInteger('views')->default(0);
            $table->string('title');
            $table->string('url');
            $table->integer('price')->nullable();
            $table->integer('regular_price')->nullable();
            $table->smallInteger('quantity')->nullable();

            $table->tinyText('short_description')->nullable();
            $table->text('overview')->nullable();
            $table->longText('features')->nullable();
            $table->longText('specifications')->nullable();
            $table->longText('includes')->nullable();
            $table->longText('accessories')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->string('image')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_small')->nullable();

            $table->foreignId('created_by');
            $table->foreignId('updated_by')->nullable();
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
