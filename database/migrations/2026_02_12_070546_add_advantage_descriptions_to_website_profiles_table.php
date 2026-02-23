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
    Schema::table('website_profiles', function (Blueprint $table) {
        $table->text('advantage_1_desc')->nullable();
        $table->text('advantage_2_desc')->nullable();
        $table->text('advantage_3_desc')->nullable();
    });
}

public function down(): void
{
    Schema::table('website_profiles', function (Blueprint $table) {
        $table->dropColumn([
            'advantage_1_desc',
            'advantage_2_desc',
            'advantage_3_desc'
        ]);
    });
}

};
