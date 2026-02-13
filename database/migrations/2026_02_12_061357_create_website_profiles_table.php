<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('website_profiles', function (Blueprint $table) {
        $table->id();

        $table->text('description')->nullable();

        $table->string('advantage_1_title')->nullable();
        $table->string('advantage_1_icon')->nullable();

        $table->string('advantage_2_title')->nullable();
        $table->string('advantage_2_icon')->nullable();

        $table->string('advantage_3_title')->nullable();
        $table->string('advantage_3_icon')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_profiles');
    }
};
