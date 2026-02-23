<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('amount', 12, 2);

            $table->enum('payment_type', [
                'dp',
                'pelunasan',
                'cicilan',
                'refund'
            ]);

            $table->string('payment_method')->nullable(); // midtrans, transfer, cash
            $table->string('reference')->nullable();      // order_id / transaction_id

            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'expired'
            ])->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
