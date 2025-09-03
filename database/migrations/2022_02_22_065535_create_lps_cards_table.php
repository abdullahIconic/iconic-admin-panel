<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLpsCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lps_cards', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(true);
            $table->string('page_name')->default('conventional');
            $table->string('card_for')->default('design-consultency');
            $table->string('card_type')->default('image');
            $table->string('title')->nullable();
            $table->tinyText('overview')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('lps_cards');
    }
}
