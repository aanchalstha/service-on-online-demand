<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('service_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->string('description');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->string('slug')->unique();
            $table->string('description', 5000);
            $table->string('other_information');
            $table->integer('service_time')->nullable();
            $table->string('service_charge');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
        Schema::create('service_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->string('description');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->string('rate');
            $table->integer('available')->default(1);
            $table->bigInteger('service_count')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_providers');
        Schema::dropIfExists('service_categories');
        Schema::dropIfExists('sub_categories');
        Schema::dropIfExists('services');

    }
}
