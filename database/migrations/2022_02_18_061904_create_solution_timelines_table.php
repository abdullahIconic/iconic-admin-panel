<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution_timelines', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(true);
            $table->string('title_1');
            $table->tinyText('overview_1');
            $table->string('title_2');
            $table->tinyText('overview_2');
            $table->string('title_3');
            $table->tinyText('overview_3');

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
        Schema::dropIfExists('solution_timelines');
    }
}
