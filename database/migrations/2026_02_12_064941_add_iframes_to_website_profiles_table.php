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
        $table->text('iframe_1')->nullable()->after('image');
        $table->text('iframe_2')->nullable()->after('iframe_1');
    });
}

public function down(): void
{
    Schema::table('website_profiles', function (Blueprint $table) {
        $table->dropColumn(['iframe_1', 'iframe_2']);
    });
}
};
