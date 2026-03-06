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
        Schema::create('kos_discounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kos_id')->constrained()->cascadeOnDelete();

            $table->string('nama');

            // jenis diskon
            $table->enum('type', ['percent', 'fixed']);

            // nilai diskon
            $table->integer('value');

            // syarat minimal
            $table->integer('min_durasi')->nullable();
            $table->bigInteger('min_total')->nullable();

            // berlaku untuk
            $table->enum('jenis_sewa', ['harian', 'bulanan', 'tahunan'])->nullable();

            // hari aktif
            $table->json('days')->nullable();

            // tanggal promo
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos_discounts');
    }
};
