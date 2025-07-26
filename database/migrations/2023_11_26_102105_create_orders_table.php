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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_code')->unique();
            $table->integer('customer_id');
            $table->integer('order_total');
            $table->integer('tax_total')->default(0);
            $table->integer('shipping_total')->default(0);
            $table->integer('shipping_discount_amount')->default(0);
            $table->integer('cod_charge')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('special_discount')->default(0);
            $table->text('order_date');
            $table->text('order_timestamp');
            $table->string('order_status')->default('Pending');
            $table->bigInteger('delivery_partner')->nullable();
            $table->longText('delivery_address');
            $table->longText('mobile');
            $table->longText('zip')->nullable();
            $table->longText('house_road_area')->nullable();
            $table->string('delivery_status')->default('Pending');
            $table->text('payment_method');
            $table->integer('payment_amount')->default(0);
            $table->text('payment_date')->nullable();
            $table->text('payment_timestamp')->nullable();
            $table->string('payment_status')->default('Unpaid');
            $table->string('currency')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('order_note')->nullable();
            $table->tinyInteger('stock_out')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
