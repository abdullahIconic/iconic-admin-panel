<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(1);
            $table->boolean('expert')->default(0);
            $table->string('expert_in')->nullable();
            $table->tinyInteger('position')->nullable();

            $table->string('name');
            $table->string('designation');
            $table->text('overview')->nullable();
            
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('image')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_small')->nullable();

            $table->boolean('support')->default(0);
            $table->boolean('contact')->default(0);
            $table->string('contact_url')->nullable();
            $table->string('support_text',2000)->nullable();
            $table->string('button_text')->nullable();

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
        Schema::dropIfExists('teams');
    }
}
