<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_map_integrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('providers_id')->unsigned();
            $table->foreign('providers_id')->references('id')->on('providers');
            $table->string('field_id');
            $table->string('field_name');
            $table->string('field_description');
            $table->string('field_price');
            $table->string('field_discountValue')->nullable();
            $table->string('field_hasDiscount')->nullable();
            $table->string('field_material')->nullable();
            $table->string('field_category')->nullable();
            $table->string('field_images')->nullable();
            $table->string('field_departaments')->nullable();
            $table->string('api_url');
            $table->string('api_token')->nullable();
            $table->string('api_username')->nullable();
            $table->string('api_password')->nullable();
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
        Schema::dropIfExists('product_map_integrations');
    }
};
