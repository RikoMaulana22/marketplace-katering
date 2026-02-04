<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->date('delivery_date');
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'delivered'])->default('pending');
            $table->timestamps();
        });
    }

    public function showOrder($id)
{
    $order = \App\Models\Order::with(['customer', 'items.menu'])
                ->where('merchant_id', auth()->user()->merchant->id)
                ->findOrFail($id);

    return view('merchant.orders.show', compact('order'));
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
