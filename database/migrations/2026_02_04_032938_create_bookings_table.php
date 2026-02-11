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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('kamar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            /*
    |--------------------------------------------------
    | DATA PENYEWA
    |--------------------------------------------------
    */
            $table->string('nama_penyewa');
            $table->string('email');
            $table->string('phone');
            $table->string('nomor_identitas')->nullable();
            $table->text('alamat')->nullable();

            /*
    |--------------------------------------------------
    | DATA SEWA
    |--------------------------------------------------
    */
            $table->enum('jenis_sewa', ['bulanan', 'tahunan']);
            $table->integer('durasi'); // bulan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            /*
    |--------------------------------------------------
    | HARGA
    |--------------------------------------------------
    */
            $table->integer('harga_per_bulan');
            $table->integer('subtotal');
            $table->integer('dp_persen')->default(0);
            $table->bigInteger('dp_nominal')->nullable(false); // wajib
            $table->integer('total_bayar');

            /*
    |--------------------------------------------------
    | STATUS BOOKING
    |--------------------------------------------------
    */
            $table->enum('status', [
                'draft',        // baru isi form
                'pending',      // menunggu pembayaran
                'paid',         // pembayaran sukses
                'confirmed',    // dikonfirmasi admin
                'cancelled',
                'expired'
            ])->default('draft');

            /*
    |--------------------------------------------------
    | PAYMENT (MIDTRANS READY)
    |--------------------------------------------------
    */
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable(); // order_id Midtrans
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
