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
        Schema::create('keuangan', function (Blueprint $table) {

    $table->id();

    $table->string('reference')->nullable();

    $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();

    $table->enum('kategori', ['pemasukan', 'pengeluaran']);

    $table->string('payment_method')->nullable();

    $table->bigInteger('pemasukan')->default(0);

    $table->bigInteger('pengeluaran')->default(0);

    $table->bigInteger('saldo')->default(0);

    $table->string('keterangan');

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
