<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(1);
            $table->tinyInteger('position')->nullable();
            $table->string('page_name');

            $table->string('slogan')->nullable();
            $table->string('slogan_color')->nullable();
            $table->string('title')->nullable();
            $table->string('title_color')->nullable();
            $table->text('overview')->nullable();
            $table->string('button_color')->nullable();
            $table->string('label_color')->nullable();

            $table->string('link')->nullable();
            $table->string('link_text')->nullable();

            $table->string('title_color')->nullable();

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
        Schema::dropIfExists('sliders');
    }
}
