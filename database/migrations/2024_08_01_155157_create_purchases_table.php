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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->date('delivery_date');
            $table->string('delivery_address');
            $table->string('payment_method');
            $table->decimal('total_payment', 10, 2);
            $table->integer('quantity');
            $table->integer('points_earned')->default(0);
            $table->string('status')->default('Processing'); // Add this line
            $table->timestamps();

                //now creating relationships
        $table->foreign('user_id')->references('id')->on('users'); 
        $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
