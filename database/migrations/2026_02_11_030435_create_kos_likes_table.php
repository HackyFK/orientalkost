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
    Schema::create('kos_likes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kos_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        $table->unique(['kos_id', 'user_id']); // agar user hanya bisa like sekali
    });
}

public function down(): void
{
    Schema::dropIfExists('kos_likes');
}

};
