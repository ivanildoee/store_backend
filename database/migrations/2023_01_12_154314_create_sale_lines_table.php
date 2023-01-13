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
        Schema::create('sale_lines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('integration_id')->unsigned()->nullable();
            $table->foreign('integration_id')->references('id')->on('product_map_integrations');
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity');
            $table->float('price_unit');            
            $table->float('price_discount');   
            $table->float('price_subtotal');            
            $table->float('price_discount_total');           
            $table->float('price_total');
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
        Schema::dropIfExists('sale_lines');
    }
};
