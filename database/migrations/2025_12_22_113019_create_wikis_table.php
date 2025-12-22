<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_wikis_table.php
public function up()
{
    Schema::create('wikis', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->string('category')->nullable();
    $table->string('tags')->nullable();
    $table->longText('content');
    $table->enum('status', ['draft','review','published','archived'])->default('draft');
    $table->foreignId('created_by')->constrained('users');
    $table->foreignId('updated_by')->nullable()->constrained('users');
    $table->timestamp('reviewed_at')->nullable();
    $table->timestamp('published_at')->nullable();
    $table->timestamp('archived_at')->nullable();
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wikis');
    }
};
