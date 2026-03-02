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
    Schema::create('pendapatan_owner', function (Blueprint $table) {
        $table->id();

        $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();

        $table->foreignId('booking_id')->constrained()->cascadeOnDelete();

        $table->decimal('total_booking', 15, 2);

        $table->decimal('pendapatan_owner', 15, 2);

        $table->decimal('pendapatan_platform', 15, 2);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatan_owner');
    }
};
