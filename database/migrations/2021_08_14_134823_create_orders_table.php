<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->foreignId('order_status_id');
            $table->foreignId('payment_method_id');
            $table->string('order_number');
            $table->float('grand_total');
            $table->integer('item_count');
            $table->boolean('is_paid')->default(false);
            // $table->enum('payment_method', ['cash_on_delivery', 'card'])->default('cash_on_delivery');
            // $table->foreignId('status', ['pending', 'processing', 'completed', 'decline']);

            $table->string('shipping_fullname');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zipcode');
            $table->string('shipping_phone');
            $table->string('notes')->nullable();

            $table->string('billing_fullname');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zipcode');
            $table->string('billing_phone');
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
        Schema::dropIfExists('orders');
    }
}
