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
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('category_id');
            $table->string('product_name')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->double('price',[10,2])->default(0);
            $table->double('total_quantity',[10,2])->default(0);
            $table->double('used_quantity',[10,2])->default(0);
            $table->double('remaining_quantity',[10,2])->default(0);
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
