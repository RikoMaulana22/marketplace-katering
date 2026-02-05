<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->decimal('total_price', 15, 2);
            $table->date('delivery_date');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained();
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_and_items_tables');
    }
};
