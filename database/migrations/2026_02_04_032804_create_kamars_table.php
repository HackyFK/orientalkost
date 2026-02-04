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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kos_id')->constrained()->cascadeOnDelete();
            $table->string('nama_kamar');
            $table->string('tipe_kamar');
            $table->integer('lantai')->nullable();
            $table->string('nomor_kamar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_bulanan', 12, 2)->nullable();
            $table->decimal('harga_tahunan', 12, 2)->nullable();
            $table->enum('status', ['tersedia', 'terisi'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
