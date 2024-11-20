<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('image');
            $table->string('product_name');
            $table->text('description');
            $table->integer('quantity');
            $table->float('price');
            $table->string('size')->nullable();
            $table->integer('stock')->default(0); // Default value of 0
            $table->timestamps();

                //now creating relationships
        $table->foreign('category_id')->references('id')->on('categories');
        // $table->foreign('user_id')->references('id')->on('users'); 
        }); 
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
