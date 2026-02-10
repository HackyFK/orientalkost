<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri_images', function (Blueprint $table) {
            $table->foreignId('galeri_id')
                ->after('id')
                ->constrained('galeris')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('galeri_images', function (Blueprint $table) {
            $table->dropForeign(['galeri_id']);
            $table->dropColumn('galeri_id');
        });
    }
};
