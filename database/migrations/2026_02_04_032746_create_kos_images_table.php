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
        Schema::create('kos_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kos_id')->constrained()->cascadeOnDelete()
                    ->constrained('kos') // ← PENTING
                    ->cascadeOnDelete();;
            $table->string('image_path');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos_images');
    }
};
