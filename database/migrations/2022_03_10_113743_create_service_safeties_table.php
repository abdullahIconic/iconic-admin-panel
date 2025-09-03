<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSafetiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_safeties', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(1);

            $table->string('slogan')->nullable();
            $table->string('title');
            $table->text('url')->nullable();
            $table->text('label')->nullable();
            $table->text('overview')->nullable();
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
        Schema::dropIfExists('service_safeties');
    }
}
